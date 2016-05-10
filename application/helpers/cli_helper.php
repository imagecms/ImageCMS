<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * Hepler functions for command line
 * Attention: tsted only on Linux
 */

if (!function_exists('_readLine')) {

    /**
     * Read user input
     * @param string (optional) $message enter message as a hint
     * @return string
     */
    function _readLine($message = '') {
        file_put_contents('php://stdout', $message);
        $handle = fopen('php://stdin', 'r');
        return trim(fgets($handle), PHP_EOL);
    }

}

if (!function_exists('_confirm')) {

    /**
     * Confirmation helper
     * @param string $question question text
     * @param boolean (optional, default true) $defaultApprove default status on enter (if empty)
     * @return boolean
     */
    function _confirm($question, $defaultApprove = true) {
        $question = rtrim($question);

        file_put_contents('php://stdout', sprintf('%s? [%s]: ', $question, $defaultApprove ? 'Y/n' : 'y/N'));
        $handle = fopen('php://stdin', 'r');
        $input = trim(fgets($handle), PHP_EOL);

        if (empty($input) && $defaultApprove) {
            return true;
        }

        if (strtolower($input) == 'y') {
            return true;
        }

        return false;
    }

}

if (!function_exists('_outputLine')) {

    /**
     * Outputs line to termainal
     * @param string $message
     */
    function _outputLine($message) {
        file_put_contents('php://stdout', $message . PHP_EOL);
    }

}

if (!function_exists('_executeAndOutputResult')) {

    /**
     * Executes linux command
     * @param string $command
     */
    function _executeAndOutputResult($command) {
        file_put_contents('php://stdout', `{$command}`);
    }

}