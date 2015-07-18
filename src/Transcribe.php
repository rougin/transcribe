<?php namespace Rougin\Transcribe;

class Transcribe
{

	protected $default    = '';
	protected $vocabulary = array();

	/**
	 * Get the directory of the files to be transcribed
	 * or a database connection to be accessed with
	 * 
	 * @param array|string  $source
	 * @param array         $indexes
	 */
	public function __construct($source = NULL, $indexes = NULL)
	{
		if ($source == NULL) {
			return;
		}

		if ( ! is_array($source) && $indexes == NULL) {
			return $this->getDirectory($source);
		}

		if (is_array($source)) {
			if ($indexes == NULL) {
				$indexes = $source['table'];
			}

			return $this->getDatabase($source, $indexes);
		}
	}

	/**
	 * Parse the data from the database
	 * 
	 * @param  array $source
	 * @param  array $indexes
	 * @return array
	 */
	public function getDatabase($source, $indexes = NULL)
	{
		$counter = 0;
		$data    = array();

		$language    = (isset($indexes['language'])) ? $indexes['language'] : 'language';
		$text        = (isset($indexes['text'])) ? $indexes['text'] : 'text';
		$translation = (isset($indexes['translation'])) ? $indexes['translation'] : 'translation';

		$dataSourceName = $source['driver'] .
			':host=' . $source['hostname'] .
			';dbname=' . $source['database'] .
			';charset=' . $source['charset'];

		$pdo = new \Slim\PDO\Database($dataSourceName, $source['username'], $source['password']);
		$table = $pdo->select()->from($indexes['name']);
		$result = $table->execute();

		while ($row = $result->fetch()) {
			$data[$row[$language]][$row[$text]] = $row[$translation];

			$counter++;
		}

		$this->vocabulary = array_merge($this->vocabulary, $data);

		return $this;
	}

	/**
	 * Get the list of words from a directory
	 * 
	 * @param   string $directory
	 * @return  array
	 */
	public function getDirectory($directory)
	{
		$result = array();
		$location = new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS);

		foreach (new \RecursiveIteratorIterator($location, \RecursiveIteratorIterator::SELF_FIRST) as $path) {
			if ($path->isDir()) {
				continue;
			}

			$data = include realpath($path->__toString());
			$group = str_replace('.php', '', $path->getFilename());

			if (is_array($data)) {
				$result[$group] = $data;
			}
		}

		$this->vocabulary = array_merge($this->vocabulary, $result);

		return $this;
	}

	/**
	 * Get the specified text from the list of defined words in the file
	 * 
	 * @param  string $string
	 * @return string
	 */
	public function getText($string = '')
	{
		$group = $this->default;

		if (strpos($string, '.') !== FALSE) {
			$strings = explode('.', $string);
			$group   = $strings[0];
			$string  = $strings[1];
		}

		if ( ! isset($this->vocabulary[$group][$string])) {
			return $string;
		}

		return $this->vocabulary[$group][$string];
	}

	/**
	 * Get all words stored from the vocabulary
	 * 
	 * @return array
	 */
	public function getVocabulary()
	{
		return $this->vocabulary;
	}

}