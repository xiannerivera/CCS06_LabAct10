<?php

namespace app;
use PDOException;

class Employee
{

	protected $dept_no;
	protected $first_name;
	protected $last_name;
	protected $from_date;
	protected $full_name;
	protected $to_date;
	protected $dept_name;
	protected $total_years;
	protected $emp_no;
	protected $salary;
	protected $birth_date;
	protected $age;
	protected $gender;
	protected $title;
	protected $hire_date;

	public	function getStartDate()
	{
		return $this->hire_date;
	}

	public function	getTitle()
	{
		return $this->title;
	}

	public function getSalary()
	{
		return $this->salary;
	}

	public function getBirth()
	{
		return $this->birth_date;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function getAge()
	{
		return $this->age;
	}

	public function getEmpNo()
	{
		return $this->emp_no;
	}
	public	function getDeptNo()
	{
		return $this->dept_no;
	}
	public function getFullName()
	{
		return $this->full_name;
	}
	public	function getHireDate()
	{
		return $this->from_date;
	}
	public function getEndDate()
	{
		return $this->to_date;
	}

	public function getDeptName()
	{
		return $this->dept_name;
	}

	public function getTotalYear()
	{
		return $this->total_years;
	}

    public static function list()
	{
		global $conn;

		try {
			$sql = "SELECT
					d.dept_no,
					d.dept_name,
					CONCAT(e.first_name, ' ', e.last_name) AS full_name,
					dm.from_date,
					CURRENT_DATE(),
					TIMESTAMPDIFF(YEAR, dm.from_date, CURRENT_DATE()) AS total_years
					FROM departments AS d
					LEFT JOIN dept_manager AS dm
					ON (d.dept_no = dm.dept_no)
					LEFT JOIN employees AS e
					ON (dm.emp_no = e.emp_no)
					WHERE dm.to_date='9999-01-01'
					ORDER BY d.dept_no ASC
					";
			$statement = $conn->query($sql);
			
			$employees = [];
			while ($row = $statement->fetchObject('App\Employee')) {
				array_push($employees, $row);
			}
			return $employees;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getById($dept_no)
	{
		global $conn;

		try {
			$sql = "SELECT
			de.emp_no,
			CONCAT(e.first_name,' ',e.last_name) AS full_name,
			e.birth_date,
			TIMESTAMPDIFF(YEAR, e.birth_date, CURRENT_DATE()) AS age,
			e.gender,
			e.hire_date,
			t.title,
			(SELECT s.salary FROM salaries s WHERE s.emp_no = e.emp_no ORDER BY s.from_date DESC LIMIT 1) as salary
			FROM dept_emp AS de
			LEFT JOIN employees AS e
			ON (de.emp_no = e.emp_no)
			LEFT JOIN titles as t
			ON (e.emp_no = t.emp_no)
			LEFT JOIN salaries as s
			ON (e.emp_no = s.emp_no)
			WHERE de.dept_no =:dept_no AND de.to_date = '9999-01-01' AND t.title != 'Manager'
			GROUP BY de.emp_no
			ORDER BY e.emp_no ASC
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'dept_no' => $dept_no
			]);
			$records = [];
			while($row = $statement->fetchObject('App\Employee')){
				array_push($records,$row);
			}
			return $records;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getByEmpNo($emp_no)
	{
		global $conn;

		try {
			$sql = "SELECT
			from_date,
			to_date,
			salary
			FROM salaries
			WHERE emp_no =:emp_no
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'emp_no' => $emp_no
			]);
			$records = [];
			while($row = $statement->fetchObject('App\Employee')){
				array_push($records,$row);
			}
			return $records;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}
	
}

?>