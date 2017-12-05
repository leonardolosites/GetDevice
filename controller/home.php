<?php

switch ($userType) {
	case '1':
		include('pages/agendamentos.php');
	break;
	case '2':
		include('pages/novo-agendamento.php');
	break;
}
?>