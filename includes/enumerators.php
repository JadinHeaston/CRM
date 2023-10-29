<?php

enum Permission: int
{
	case Void = 1;
	case Administrator = 2;
	case Viewer = 3;
	case Requestor = 4;
	case Reviewer = 5;

	function displayOption()
	{
		return '<option value="' . $this->value . '">' . $this->name . '</option>';
	}
}

enum Priority: int
{
	case Void = 1;
	case Low = 2;
	case Medium = 3;
	case High = 4;
	case Emergency = 5;

	function displayOption()
	{
		return '<option value="' . $this->value . '">' . $this->name . '</option>';
	}
}

enum Result: int
{
	case Void = 1;
	case Successful = 2;
	case Failed = 3;
	case Cancelled = 4;

	function displayOption()
	{
		return '<option value="' . $this->value . '">' . $this->name . '</option>';
	}
}

enum Status: int
{
	case Void = 1;
	case Draft = 2;
	case Requested = 3;
	case Approved = 4;
	case Denied = 5;
	case Deleted = 6;

	function displayOption()
	{
		return '<option value="' . $this->value . '">' . $this->name . '</option>';
	}
}

enum Type: int
{
	case Void = 1;
	case Normal = 2;
	case Emergency = 3;

	function displayOption()
	{
		return '<option value="' . $this->value . '">' . $this->name . '</option>';
	}
}
