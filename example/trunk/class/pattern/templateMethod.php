<?php

abstract class TextReader 
{
	// templateMethod()
	public function readFileProcess() {
		$this->openFile();
		$this->readFile();

		// 這邊加上了hook, 讓子類別可以決定是不是要在演算法中使用parserFile()
		if ($this->hook() == true) {
			$this->parseFile();
		}
		
		$this->showFile();
		$this->closeFile();
	} 

	// 共同的實現部分可以放在父類別, 避免程式碼重複
	protected function openFile() {
		echo "開啓檔案<br>";
	}

	protected abstract function readFile();   // primitiveOperation()
	protected abstract function parseFile();  // primitiveOperation()
	protected abstract function showFile();   // primitiveOperation()
	protected abstract function closeFile();  // primitiveOperation()

	protected function hook() { // Hook方法
		return true;
	}
}

class WordTextReader extends TextReader 
{
	protected function readFile() {
		echo "讀取Word .doc格式檔案<br>";
	}

	protected function parseFile() {
		echo "解析Word .doc格式檔案<br>";
	}

	protected function showFile() {
		echo "顯示Word .doc格式檔案<br>";
	}

	protected function closeFile() {
		echo "關閉Word .doc格式檔案<br>";
	}
}

class AdobeTextReader extends TextReader 
{
	protected function readFile() {
		echo "讀取Adobe .pdf格式檔案<br>";
	}

	protected function parseFile() {
		echo "";
	}

	protected function showFile() {
		echo "顯示Adobe .pdf格式檔案<br>";
	}

	protected function closeFile() {
		echo "顯示Adobe .pdf格式檔案<br>";
	}

	// 覆寫了父類別的Hook
	protected function hook() {
		return false;
	}
}
?>