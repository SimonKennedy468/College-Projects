CLASSES:
Control.java: Basic control class to initalize the GUI.java class

FileProcessor.java: Interface that holds the search function. Passes the search term, the search space and a check to see if it just wants the
		    results from a search, or to open the file with the best match. It filters all but the .txt files in the passed directory. An example from
		    https://stackabuse.com/java-list-files-in-a-directory/ was used to make this filter. If there no directory in the text field, it will use the 
                    C:\as a default. It will cycle through each file, and check each line of those files. The current file line gets checked to see if it contains 
                    the search term. If it dosent, it will take one letter of the end of the search term. After this, it will remove the 1st letter off the string, 
                    and repeat the process of removing the end of the string. For example, the search "test" will run as follows:
		    ********************************
		    1st pass
		    test
	 	    tes
		    te
		    t
		    
		    2nd pass
		    est
		    st
		    t

		    3rd pass
		    st
		    t

		    4th pass
	 	    t

		    ********************************
		    when a match is found, it will take the length of this matching substring and save it to curr_match as a percentage. if this is a higher than final_match
		    a better match has been found, and final_match is set to curr_match. If the final_match is higher than file_match, then a file with a better
		    match has been found, and file_match is set to final_match. When all lines of the file have been set, the final_match result and added to 
		    the results_set set. Once all files in the directory have been searched, results_set is sorted and reversed, as in the Collections.sort 
		    function, 100 < 999 because it sees 1 as being less than 9. To catch this, if the result is 100, it is added to the final_results string
		    first and subsequently removed from the list. If the match is less than 10, it is saved to the "small_sort" array, and sorted, reversed and added last. 
		    The index for this for loop is then reset to 0 as the length of the set has been changed.
		    If there were no files found, final_results is set to an error message that no files were found. Finally, if the user asked for a basic
		    search, the final_results string is returned. If the user asked for a search and the file with the best matched to be opened, the file_to_open
		    is returned. 

GUI.java: Class to fill and run Graphical user interface. Its a gridLayout(3,1) with 3 flowLayout panels. The top panel contains a textfield and label.
	  the text field is used to find the directory to be searched. The middle panel contains a textfield and label used to find the search term. 
	  The bottom panel contains the buttons to just search and present the results, or open the file with the best match. When the search button is pressed,
	  the search term is checked. If it is blank, an error is displayed to the user. If it has text, it is saved to the search_term string. the search space is
	  then checked. If this is empty, the search_space string is set to the C:/ directory. If it has text, it is passed to the removeEscapeChar function. 
	  The search_term and search_space strings are then passed to the FileProcessor.searchForTerm method along with the boolean value true to indicate it wants
          the result to be a basic search. This is run in a JOptionPane.showMessageDialog. If the open_file button is pressed, the values for search_term and search_space
	  are checked and set just like the search button, and the string "open" is set to the results from the FileProcessor.searchForTerm method. open is then 
	  sent to the removeEscapeChar method. If it is blank after this, an error message is displayed. Otherwise, the ProcessBuilder function is run and the file
	  is opened in notepad. The code for the ProcessBuilder function, on lines 175 to 183 was taken from 
          https://stackoverflow.com/questions/3487149/how-to-open-the-notepad-file-in-java.
	  The removeEscapeChar method takes a string and cycles through each character. If an escape character (\) is found, it is replaced with a / so that
	  it is read by the FileProcessor as a directory name and not several escape characters. The string is then returned. 

IF THERE WAS MORE TIME: JFileChooser would be implemented as opposed to a textfield. 
			Fix a small bug where if there is a mismatch in the center of the string, ie "tust" instead of "test", a 50% match is found instead of a 75%
			match. This is because the search is finding the "st" at the end as the best match.
			More types of files rather than just .txt files could be searched through.  
			More design in the GUI, as it is rather basic at the moment.
			Implementation of logic such as AND or OR within the search.

VIDEO LINK:https://youtu.be/bdWDyvZcC3E
			
			