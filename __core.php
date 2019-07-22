<?php

/* * *********************************************************
 * ******** Core 
 * ******** V 1.1 - REV 8
 * stywill@gmail.com / w.oliveira@brandworks.com.br
 * ******************************************************* */

// DEV
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

error_reporting(E_PARSE);
//import_request_variables("gP","");
extract($_GET, EXTR_REFS, "");
extract($_POST, EXTR_REFS, "");
extract($_REQUEST, EXTR_REFS, "");

class core {

    protected $DB_HOST;
    protected $DB_USER;
    protected $DB_PASS;
    protected $DB_DATA;
    public $dispositivo = "tab1";
    public $db_prefix = "bwf_"; // prod
    public $_debug = False;
    public $_debug_visible = true; // abre a pagina com o debug aberto ? se tiver false tem como abrir n precisa deixar aberto sempre
    public $_debug_container = array(
        'OUT' => '',
        'SQL' => '',
        'WRN' => '',
        'ERR' => '',
        'TIM' => ''
    );

    private function core() {
        if (version_compare(PHP_VERSION, "5.0.0", "<")) {
//$this->__construct("127.0.0.1","root","","bw_formularios");
            register_shutdown_function(array($this, "__destruct"));
        }
    }

    public function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_DATA) {
        $this->setDB_HOST($DB_HOST);
        $this->setDB_USER($DB_USER);
        $this->setDB_PASS($DB_PASS);
        $this->setDB_DATA($DB_DATA);

        $this->dbg_in('OUT', __FUNCTION__);
        $this->database(1);
    }

    public function __destruct() {
        $this->dbg_in('OUT', __FUNCTION__);

        $this->database(0);

        if ($this->_debug) {
            echo $this->dbg_out();
        }

        unset($this->_core);
        unset($this->_debug_container);
        unset($this->_debug);
    }

// versão PHP workaround de classes


    public function getDB_HOST() {
        return $this->DB_HOST;
    }

    public function setDB_HOST($DB_HOST) {
        $this->DB_HOST = $DB_HOST;
        return $this;
    }

    public function getDB_USER() {
        return $this->DB_USER;
    }

    public function setDB_USER($DB_USER) {
        $this->DB_USER = $DB_USER;
        return $this;
    }

    public function getDB_PASS() {
        return $this->DB_PASS;
    }

    public function setDB_PASS($DB_PASS) {
        $this->DB_PASS = $DB_PASS;
        return $this;
    }

    public function getDB_DATA() {
        return $this->DB_DATA;
    }

    public function setDB_DATA($DB_DATA) {
        $this->DB_DATA = $DB_DATA;
        return $this;
    }

    private function database($action) {
        $this->dbg_in('OUT', __FUNCTION__);
        if ($action) {
            $this->_db = mysqli_connect($this->getDB_HOST(), $this->getDB_USER(), $this->getDB_PASS(), $this->getDB_DATA());

            if (mysqli_connect_errno()) {
                $this->dbg_in('ERR', 'Falha conexao com SQL - (' . mysqli_connect_errno() . ') : ' . mysqli_connect_error());
            } else {
                $this->dbg_in('SQL', __FUNCTION__ . ' CONNECT');
            }
// ajusta acentuação
            mysqli_set_charset($this->_db, 'utf8');
        } else {
            mysqli_close($this->_db);
            $this->dbg_in('SQL', __FUNCTION__ . ' CLOSE');
        }

        return 1;
    }

    public function sql($type, $query) {
        if (!$type) { // LEITURA / SELECT - retorna query pronta para fetch
            $getq = mysqli_query($this->_db, $query);
            if (mysqli_errno($this->_db)) {
                $this->dbg_in('ERR', 'FALHA SQL - (' . mysqli_errno($this->_db) . ') : ' . mysqli_error($this->_db) . ' -- QUERY: {' . $query . '}');
            }
            return $getq;
        } else { // ESCRITA
//$histr = $this->histread($type);
            if ($type == "I") {
                mysqli_query($this->_db, $query) or die(mysqli_errno($this->_db) . ' : ' . mysqli_error($this->_db) . ' -- ' . $query);
                $use_return = mysqli_insert_id($this->_db);
            } elseif ($type == "U" || $type == "D") {
                mysqli_query($this->_db, $query) or die(mysqli_errno($this->_db) . ' : ' . mysqli_error($this->_db) . ' -- ' . $query);
                $use_return = mysqli_affected_rows($this->_db);
            } elseif ($type == "R") { //delete efetivo, provavelmente n sera usado
            }

            if (mysqli_errno($this->_db)) {
                $this->dbg_in('ERR', 'FALHA SQL - (' . mysqli_errno($this->_db) . ') : ' . mysqli_error($this->_db) . ' -- TYPE: ' . print_r($type) . ' -- QUERY: {' . $query . '}');
            } else {
                $this->dbg_in('SQL', __FUNCTION__ . ' OK - Type:' . $type . ' retornou ' . $use_return . ' {' . $query . '}');
                return $use_return;
            }
        }
    }

    private function dbg_in($type, $data) {
        $this->_debug_container[$type] .= "{" . date("Y-m-d H:i:s") . "} " . $data . "\r\n";
        switch ($type) {
            case 'OUT': $uf = "<font color=green><strong>OUT</strong></font>";
                break;
            case 'SQL': $uf = "<font color=blue><strong>SQL</strong></font>";
                break;
            case 'WRN': $uf = "<font color=orange><strong>WRN</strong></font>";
                break;
            case 'ERR': $uf = "<font color=red><strong>ERR</strong></font>";
                break;
            default: die('dbg_in TYPE invalido - enviado ' . $type);
                break;
        }
        $this->_debug_container['TIM'] .= $uf . " {" . date("Y-m-d H:i:s") . "} " . $data . "\r\n";
    }

    private function dbg_out() {
        if ($this->_debug_visible) {
            $dbsu = "block";
        } else {
            $dbsu = "none";
        }
        $dbstr = '<br><br><br><br><br><br><br><div align=center style="color:#ddd;"><a href="javascript:$(\'#debugbox\').toggle(\'fast\');">&nbsp;&nbsp;&nbsp;</a></div>'; //toggle no futuro entra aqui
        $dbstr .= '<div id="debugbox" name="debugbox" style="display:' . $dbsu . '; position: relative; left: 0px; width:98%; background-color:#FFF; border: 1px solid #F00; margin: 5px; padding: 5px;">';
//
        $dbstr .= '<div align=center><strong>dbg</strong></div><br><pre>';
        $dbstr .= '<font color=green><strong>OUT</strong></font><br>' . htmlspecialchars(print_r($this->_debug_container['OUT'], true)) . '<br><br>';
        $dbstr .= '<font color=blue><strong>SQL</strong></font><br>' . htmlspecialchars(print_r($this->_debug_container['SQL'], true)) . '<br><br>';
        $dbstr .= '<font color=orange><strong>WRN</strong></font><br>' . htmlspecialchars(print_r($this->_debug_container['WRN'], true)) . '<br><br>';
        $dbstr .= '<font color=red><strong>ERR</strong></font><br>' . htmlspecialchars(print_r($this->_debug_container['ERR'], true)) . '<br><br><br>';
        $dbstr .= '<font color=black><strong>OrdemExec</strong></font><br>' . print_r($this->_debug_container['TIM'], true) . '<br><br><br>';
        $dbstr .= '<font color=black><strong>_vars</strong></font><br>' . print_r($this->_vars, true) . '<br><br><br>';
        $dbstr .= '</pre>';
        $dbstr .= '<hr size=80 color="#FF0000">';
        $dbstr .= '<pre>' . htmlspecialchars(print_r(get_defined_vars(), true)) . '</pre>';
        $dbstr .= '<hr size=80 color="#FF0000">';
        $dbstr .= '<pre>' . htmlspecialchars(print_r($_SERVER, true)) . '</pre></div>';
        $dbstr .= ''; // /toggle	
        return $dbstr;
    }

    public function gsi($item, $table, $where) {
        if ($where) {
            $where = "WHERE " . $where;
        } else {
            $where = "";
        }
        $getc = mysqli_query($this->_db, "SELECT " . $item . " FROM " . $this->db_prefix . $table . " " . $where);
        $rr = mysqli_fetch_object($getc);
        $itemres = $rr->$item;
        if (mysqli_errno($this->_db)) {
            $this->dbg_in('ERR', 'FALHA GSI - (' . mysqli_errno($this->_db) . ') : ' . mysqli_error($this->_db) . ' -- PARAMS: ' . $debug);
        }
        unset($rr);
        mysqli_free_result($getc);
        return $itemres;
    }

    public function gsim($item, $table, $where, $tipo = "multipos") {
        if ($where) {
            $where = " WHERE " . $where;
        } else {
            $where = "";
        }
        if ($item) {
            $apelido = explode('|', $item);
            $item = ($apelido[1]) ? $apelido[0] . "'" . $apelido[1] . "'" : $item;
        } else {
            $item = "*";
        }
        $gett = $this->sql(NULL, "SELECT " . $item . " FROM " . $this->db_prefix . $table . $where);
        if ($tipo == "multipos") {
            while ($row = mysqli_fetch_object($gett)) {
                $linha[] = $row;
            }
        } else {
            $row = mysqli_fetch_object($gett);
            $linha = $row->$item;
        }
        unset($row);
        return $linha;
    }

    public function gsi2($item, $table, $where) {
        if ($where) {
            $where = "WHERE " . $where;
        } else {
            $where = "";
        }
        $item = (!$item) ? "*" : $item;
        return "SELECT " . $item . " FROM " . $this->db_prefix . $table . " " . $where;
    }

    function now() {
        return date("Y-m-d H:i:s");
    }

    function checked($linha) {
        return ($linha) ? "checked" : "";
    }

    function alert($resposta) {
        if ($resposta == "S") {
            return "alert alert-success";
        } elseif ($resposta == "N") {
            return "alert alert-danger";
        } else {
            return "";
        }
    }

    function mensagem($resposta) {
        if ($resposta == "S") {
            return "Acertou";
        } elseif ($resposta == "N") {
            return"Errou";
        } else {
            return "";
        }
    }

}
