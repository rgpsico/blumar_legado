<?php

// INITIAL XML 
//
// THE SKELETON OF XML THAT WE WILL ADD THE DIRECTORY'S CONTENTS TO

$xml_string = '<?xml version="1.0" encoding="UTF-8"?>
<files>
</files>';
 
$xml_generator = new SimpleXMLElement( $xml_string );

// READ DIRECTORY FUNCTION
// readDirectory( $directory_string, $current_directory_node);
//
// $directory_string
//
//	A relative path to the directory you want to read
//
// $current_directory_node
//
//	The XML node you want the contents of the directory added to



readDirectory('/var/www/wwwinternet/bancoimagemfotos/comercial', $xml_generator); 

$count = 0;

function readDirectory($directory_string, $current_directory_node)
{



	// OPEN THE DIRECTORY, WHICH RETURNS A DIRECTORY HANDLE
	$directory_handle = opendir( $directory_string );

	if ( $directory_handle )
	{
			// GET FILES
			$files = scandir( $directory_string);

			foreach ($files as $file_string)
			{

				// BUILD A FILE PATH FROM THE ORIG DIRECTORY + THE CURRENT FILE'S PATH
				$full_file_path = $directory_string.'/'.$file_string;

				// IS THIS A FILE?
				if ( is_file( $full_file_path ) )   
				{

						// ADD TO XML
						$file = $current_directory_node->addChild('imagem', $full_file_path );
                       // $file->addChild('imagem', $full_file_path);
						//$file->addAttribute('path', $full_file_path);
					
				}

				// IS THIS A DIRECTORY? && EXCLUDE THE CURRENT AND PARENT DIRECTORIES
				else if ( is_dir( $full_file_path ) && $file_string != '..' && $file_string != '.') 
				{ 


						// ADD TO XML
					if ($count ==  0)
					{
					$directory = $current_directory_node->addChild( 'tipo');
                    $directory->addChild('tipo', $file_string);
					//$directory->addChild('nome', $file_string);
					}
					elseif ($count ==  1)
					{
					$directory = $current_directory_node->addChild( 'cidade');
                    $directory->addChild('cidade', $file_string);
					//$directory->addChild('nome', $file_string);
					}
					else
					{
					$directory = $current_directory_node->addChild( 'directory' );
					$directory->addChild('nome', $file_string);
					}
						
						//$directory->addAttribute('name', $file_string);

						// REPEAT readDirectory() USING THIS FOLDER AS THE CURRENT XML DIRECTORY NODE
						readDirectory($full_file_path, $directory);
					
                      
				}
                $count = $count + 1;
			}
			
			// NO MORE FILES? CLOSE THE DIRECTORY
			closedir( $directory_handle );
	}
}
 
// CREATE A XML HEADER (SINCE THIS FILE IS PROBABLY .php)
header("Content-Type: text/xml");
// ECHO ALL OUR XML
 
echo $xml_generator->asXML();
?>