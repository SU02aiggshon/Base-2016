<?php
// Generator
/*function myGenerator(){
	yield 'value1';
	yield 'value2';
	yield 'value3';
}


foreach (myGenerator() as $yieldmedValue){
	echo $yieldmedValue , PHP_EOL;
}*/


/*function makeRange($length){
	$dataset = [];
	for($i = 0; $i < $length; $i++){
		$dataset[] = $i;
	}
	return $dataset;
}

$customRange = makeRange(1000000);
foreach ($customRange as $key => $value) {
	echo $value , PHP_EOL;
}*/

/*function makeRange($length){
	for($i = 0; $i < $length; $i++){
		yield $i;
	}
}

foreach (makeRange(1000000) as $key => $value) {
	echo $value , PHP_EOL;
}*/


// namespace
/*namespace My\App;

class Foo{
	public function doSomething(){
		throw new Exception();

	}
}*/

// Code to an Interfce
class DocumentStore{
	protected $data = [];

	public function addDocument(Documentable $document){
		$key = $document->getId();
		$value = $document->getContent();
		$this->data[$key] = $value;
	}

	public function getDocuments(){
		return $this->data;
	}
}


interface Documentable{
	public function getId();
	public function getContent();
}


class HtmlDocument implements Documentable{
	protected $url;

	public function __construct($url){
		$this->url = $url;
	}

	public function getId(){
		return $this->url;
	}

	public function getContent(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		$html = curl_exec($ch);
		curl_close($ch);

		return $html;
	}
}

class StreamDocument implements Documentable{
	public function getId(){}

	public function getContent(){}
}


































