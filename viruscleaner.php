<?php

/**
* Php malicious injection codes removal guide & script for beginner programmers, wordpress users & php hobbyists
*  
* Read the all comments before running. 
* 1. Start with getting all subfolders in the infected main directory.
* 2. Then paste these sub directories in the $subfolders array.
* 3. Open a malicious code contained file. 
* Copy its beginning and ending to the injectedCodeBeginning and injectedCodeEnding variables. 
* 4. After you finish with editing this script, run it from your server via sudo access. 
* 
* Notes: 
* You should start <?php and finish with ?> for exact removal.
* 
* If you can't open the files via your text editor because of your OS virus program, 
* use putty to remote connect your server and type "nano absolutepathtofile/viruscleaner.php" 
* to open it via linux nano text editor. Mouse left click selection copies the highlighted. 
*      
**/


// Copy paste your subfolders here, you can use "find . -type d > output.txt" in linux command line inside the selected directory.
$subfolders = array("SUBFOLDER 1, SUBFOLDER 2, SUBFOLDER 3");

// Enter the loop to check every subfolder  
for ($i=0; $i < count($subfolders) ; $i++) {

    // Enter your target directory to check and clean up.
    $targetedDirectory = '/var/www/YOURMAINDIRECTORYLOCATION'.$subfolders[$i];
     
    $injectedCodeBeginning = '<?php $dpnxnh = ';  // Paste here the malicious code <?php beginning
    $injectedCodeEnding = '$dpnxnh=$dtntixynsiu-1; ?>'; // Paste here the malicious code ending 

    // Iterates every file inside the subfolder
    $directoryIterator = new RecursiveDirectoryIterator($targetedDirectory); 
    $iterator = new RecursiveIteratorIterator($directoryIterator);
     
    $decontaminated_files_count = 0; // Reset the injected file counter
     
    foreach ($iterator as $filename => $cur){
        
        $path_info = pathinfo($filename);
        
        if (!isset($path_info['extension'])) {  // Check if the file is not a directory
            continue;
        }             
        if ($path_info['extension'] !== 'php') { // Check if the file extension is php
            continue;
        }
     
        echo "Checking: '".$filename."'".PHP_EOL;   // Start virus checking in the pointed php file 
         
        $contents = file_get_contents($filename);   // Get all content of the file
         
        $injectedCodeBeginPosition = strpos($contents, $injectedCodeBeginning);
     
        if ($injectedCodeBeginPosition !== false && $filename !== __FILE__) {
            echo "Injection found in '".$filename."'".PHP_EOL;
             
            $injectedCodeEndingPosition = strpos($contents, $injectedCodeEnding) + strlen($injectedCodeEnding);
             
            // Look for the file content that doesn't have malicious codes
            $before_virus_content = substr($contents, 0, $injectedCodeBeginPosition);
            $after_virus_content = substr($contents, $injectedCodeEndingPosition);
             
            echo "Injection content between start position: ".$injectedCodeBeginPosition." and end position: ".$injectedCodeEndingPosition." deleted".PHP_EOL;

            // Put back what's left without the malicious code         
            $contents = $before_virus_content.$after_virus_content;   
            file_put_contents($filename, $contents);
             
            $decontaminated_files_count++;
        }
    }
 
    echo $decontaminated_files_count." files were infected and decontaminated in the directory '".$targetedDirectory."'".PHP_EOL;

}

