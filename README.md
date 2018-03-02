= phine-framework =

This is the PHP framework of the Phine CMS. It can be used without the CMS and provides the following features.
- Logic for forms, fields and validations
- Database ORM System and SQL fluent classes
- A PHP Writer to generate PHP code by PHP (also used by ORM)
- Logic for ACL to provide Access Guarding
- Logic for wording and translation using C#-String.Format placeholders like "This file was uploaded {0} times" , and PHP or CSV translation files 
- Classes for file system operations and uploads (IO)
- Multibyte capable String class an and a StringReader for iterating multibyte strings
- RSS 2.0 and sitemap generator classes
- Apache Utilities including an htaccess writer
- A PHP writer class
- Simple text operations, like string shortening or whitespace normalization
- An abstract approach to make PHP class provide its methods and its results as json webservice
- Some basic graphic capabilities using gd functions

== Version History ==

=== 1.0.0 ===

First packagist available version

=== 1.0.1 ===

- changed database type defs to avoid collisions with PHP 7 built-in types (CAUTION: Update your references!)
- added global number parser accepting dot or comma as decimal separator
- added number validator based on GlobalNumberParser

=== 1.0.2 ===
 
- corrected stupid bug in global number parser

=== 1.0.3 ===

- added GlobalNumberParser::Parse utility function
