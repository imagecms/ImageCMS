<?php

class ImageCMS_Sniffs_Globals_MakeSafeGlobalsSniff extends MySource_Sniffs_PHP_GetRequestDataSniff {

    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();

        $varName = $tokens[$stackPtr]['content'];
        if ($varName !== '$_REQUEST' && $varName !== '$_GET' && $varName !== '$_POST' && $varName !== '$_FILES' && $varName !== '$_SERVER') {
            return;
        }

        // The only place these super globals can be accessed directly is
        // in the getRequestData() method of the Security class.
        $inClass = false;
        foreach ($tokens[$stackPtr]['conditions'] as $i => $type) {
            if ($tokens[$i]['code'] === T_CLASS) {
                $className = $phpcsFile->findNext(T_STRING, $i);
                $className = $tokens[$className]['content'];
                if (strtolower($className) === 'security') {
                    $inClass = true;
                } else {
                    // We don't have nested classes.
                    break;
                }
            } else if ($inClass === true && $tokens[$i]['code'] === T_FUNCTION) {
                $funcName = $phpcsFile->findNext(T_STRING, $i);
                $funcName = $tokens[$funcName]['content'];
                if (strtolower($funcName) === 'getrequestdata') {
                    // This is valid.
                    return;
                } else {
                    // We don't have nested functions.
                    break;
                }
            }//end if
        }//end foreach
        // If we get to here, the super global was used incorrectly.
        // First find out how it is being used.
        $globalName = strtolower(substr($varName, 2));
        $usedVar = '';

        $openBracket = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if ($tokens[$openBracket]['code'] === T_OPEN_SQUARE_BRACKET) {
            $closeBracket = $tokens[$openBracket]['bracket_closer'];
            $usedVar = $phpcsFile->getTokensAsString(($openBracket + 1), ($closeBracket - $openBracket - 1));
        }

        $type = 'SuperglobalAccessed';
        $error = 'The %s super global must not be accessed directly; use Security::getRequestData(';
        $data = array($varName);
        if ($usedVar !== '') {
            $type .= 'WithVar';
            $error .= '%s, \'%s\'';
            $data[] = $usedVar;
            $data[] = $globalName;
        }

        $error .= ') instead';
        $phpcsFile->addError($error, $stackPtr, $type, $data);
    }

//end process()
}
