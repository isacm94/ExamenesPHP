<?php
/**
 * Devuelve la letra que le corresponde al NIF a un DNI
 * @param string $dni
 */
function dni_LetraNIF($dni)
{
	return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1);
}