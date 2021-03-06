<?php
namespace Estrume\Model;

use Estrume\Library as Library;

class Link
{
	public $url;
	public $id;
	public $db;
	
	public function __construct()
	{
		$this->db = new Library\Connection();
		$chars = array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
						"a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
						"k", "l", "m", "n", "o", "p", "q", "r","s", "t", 
						"u", "v", "w", "x", "y", "z", "A", "B", "C", "D",
						"E", "F", "G", "H", "I", "J", "K", "L", "M", "N",
						"O", "P", "Q", "R", "S", "T", "U", "V", "W", "X",
						"Y", "Z"
					);
						
		Library\Shortener::characters( $chars );
		$this->shortener = new Library\Shortener();
	}

	private function getUrlById($id)
	{
		$sql = "SELECT `url` FROM Links WHERE id = :id";
		
		$sth = $this->db->prepare($sql);
		$sth->bindParam(":id", $id, \PDO::PARAM_INT);
		
		if ($sth->execute()) {
			$row = $sth->fetch(\PDO::FETCH_ASSOC);
			if (isset($row['url'])) {
				return $row['url'];
			}
		}

		return false;
	}
	
	public function getOriginal($code)
	{
		$id = $this->shortener->code($code)->convert();
		
		if (!$id) return false;

		return $this->getUrlById($id);
	}
	
	public function shorten($url)
	{
		$url = $this->filterUrl($url);

		if (!$url) 
			return false;

		$id = $this->saveUrl($url);
		
		if($id) {
			$code = $this->shortener->int($id)->convert();
			return $code;
		} else {
			throw new \Exception("We couldn't save your link. Sorry.");
			return false;
		}
	}

	private function startsWithHttp($url)
	{
		return substr(trim(strtolower($url)), 0, 7) === "http://";
	}
	
	private function startsWithHttps($url)
	{
		return substr(trim(strtolower($url)), 0, 8) === "https://";
	}

	private function checkForUrlScheme($url)
	{
		if (!$this->startsWithHttp($url) && !$this->startsWithHttps($url))
			$url = "http://".$url;

		return $url;
	}

	private function itsMine($url)
	{
		$parsed_url = parse_url($url);
		
		return $parsed_url['host'] == "estru.me";
	}

	private function filterUrl($url)
	{
		$url = $this->checkForUrlScheme($url);
		$filtered_url = filter_var($url, FILTER_VALIDATE_URL);
		
		if ($filtered_url === false || $this->itsMine($url)) {
			throw new \Exception("Invalid url.");
			return false;
		}
		
		return $filtered_url;
	}

	public function checkForHits($ip)
	{
		$number_of_hits = apc_fetch($ip);

		if ($number_of_hits === false) {
			apc_store($ip, 1, 3600);
			$to_compare = 1;
		} else {
			apc_inc($ip);
			$to_compare = $number_of_hits + 1;
		}
		
		if ($to_compare >= 1000)
			return false;
		
		return true;
	}

	private function saveUrl($url)
	{
		$sql = "INSERT INTO `Links`(url) VALUES (:url)";
		$sth = $this->db->prepare($sql);
		$sth->bindParam(":url", $url, \PDO::PARAM_STR);
		
		if ($sth->execute()) {
			return $this->db->lastInsertId();
		}
		
		return false;
	}
}