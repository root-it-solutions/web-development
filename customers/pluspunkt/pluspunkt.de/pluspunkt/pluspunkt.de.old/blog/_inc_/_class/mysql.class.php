<?php

	class mySQL {
		var $dbHost;
		var $dbUser;
		var $dbPass;
		var $dbName;
		var $dbConn;
		var $connectError;
		
		function mySQL($dbHost, $dbUser, $dbPass, $dbName) {
			$this->dbHost = $dbHost;
			$this->dbUser = $dbUser;
			$this->dbPass = $dbPass;
			$this->dbName = $dbName;
			$this->connectToDb();
		}
		
		function connectToDb() {
			if( !$this->dbConn = @mysql_connect($this->dbHost, $this->dbUser, $this->dbPass) ) {
				trigger_error('Could not connect to server', E_USER_ERROR);
				$this->connectError = true;
			} else if( !@mysql_select_db($this->dbName, $this->dbConn) ) {
				trigger_error('Could not select database', E_USER_ERROR);
				$this->connectError = true;
			}
		}
		
		function isError() {
			if( $this->connectError ) {
				return true;
			}
			$error = mysql_error($this->dbConn);
			if( empty($error) ) {
				return false;
			} else {
				return true;
			}
		}
		
		function query($sql) {
			if( !$queryResources = mysql_query($sql, $this->dbConn) ) {
				trigger_error('Query failed: ' . mysql_error($this->dbConn) . '<br/> SQL: ' . $sql, E_USER_ERROR);
			}
			return new mySQLResult($this, $queryResources);
		}
	}
	
	class mySQLResult {
		var $mysql;
		var $query;
		
		function mySQLResult($mysql, $query) {
			$this->mysql = $mysql;
			$this->query = $query;
		}
		
		function fetch() {
			if( $row = mysql_fetch_array($this->query) ) {
				return $row;
			} else if( $this->size() > 0 ) {
				mysql_data_seek($this->query, 0);
				return false;
			} else {
				return false;
			}
		}
		
		function size() {
			return mysql_num_rows($this->query);
		}
		
		function insertID() {
			return mysql_insert_id($this->mysql->dbConn);
		}
		
		function isError() {
			return $this->mysql->isError();
		}
	}
	
?>