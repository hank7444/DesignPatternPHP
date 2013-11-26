<?php

// AbstractExpression
interface AbstractExpression 
{
	public function interpret();
}

// TerminalExpression
class NumberExpression implements AbstractExpression 
{
	protected $number = 0;

	public function __construct($number) {
		$this->number = $number;
	}

	public function interpret() {
		return $this->number;
	}
}

// NonterminalExpression
class AddExpression implements AbstractExpression 
{
	protected $leftExpression;
	protected $rightExpression;

	public function __construct($left,  $right) {
		$this->leftExpression = $left;
		$this->rightExpression = $right;
	}

	public function interpret() {
		return $this->leftExpression->interpret() + $this->rightExpression->interpret();
	}
} 

// NonterminalExpression
class SubtractExpression implements AbstractExpression
{
	protected $leftExpression;
	protected $rightExpression;

	public function __construct($left,  $right) {
		$this->leftExpression = $left;
		$this->rightExpression = $right;
	}

	public function interpret() {
		return $this->leftExpression->interpret() - $this->rightExpression->interpret();
	}
}

// Context
class Calculator
{
	private $statement = "";
	private $expression = null;

	public function build($statement) {
		$left = null;
		$right = null;
		$stack = array();
		$statementArr = explode(" ", $statement);

		for ($i = 0, $statementArrCount = count($statementArr); $i < $statementArrCount; $i++) {

			if ($statementArr[$i] == "+") {
				$left = array_pop($stack);
				$val = $statementArr[++$i];

				$right = new NumberExpression($val);
				$stack[] = new AddExpression($left, $right);

			} else if($statementArr[$i] == "-") {
				$left = array_pop($stack);
				$val = $statementArr[++$i];

				$right = new NumberExpression($val);
				$stack[] = new SubtractExpression($left, $right);

			} else {
				$stack[] = new NumberExpression($statementArr[$i]);
			}
		}
		$this->expression = array_pop($stack);

	}

	public function compute() {
		return $this->expression->interpret();
	}
}


?>