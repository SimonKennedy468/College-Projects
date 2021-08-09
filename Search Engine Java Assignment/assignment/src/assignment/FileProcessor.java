package assignment;

import java.io.File;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashSet;
import java.util.Scanner;
import java.util.Set;
import java.io.FileNotFoundException;
import java.io.FilenameFilter;

public interface FileProcessor 
{
	public static String searchForTerm(String search_term, String search_space, Boolean search)
	{//searchForTerm open
		String check_line;
		String curr_search;
		String result_sort;
		String final_result = "";
		String file_to_open = "";
		
		Set<String> results_set = new HashSet<String>();
		
		int i;
		int j;
		int k;
		float final_match = 0;
		float curr_match = 0;
		float file_match = 0;
		
		//set search term
		System.out.println("the search term is " + search_term);
		curr_search = search_term;
		//search through all .txt files in directory, and store them in array
		try
		{//try open
			//set directory to search, and filter out all but .txt files
			File dir = new File(search_space);
			
			//filter example taken from https://stackabuse.com/java-list-files-in-a-directory/
			FilenameFilter filter = new FilenameFilter()
					{
						public boolean accept(File dir, String filename)
						{
							return filename.endsWith(".txt");
						}
					};
			//end of what was taken
					
			File[] files_in_dir = dir.listFiles(filter);
			//cycle through all files
			for(k=0;k<files_in_dir.length;k++)
			{//files open
				File curr_file_check = (files_in_dir[k]);
				System.out.println(curr_file_check);
				final_match = 0;
				try
				{//try 2 open
					Scanner reader = new Scanner(curr_file_check);
					
					//while there are more lines in the file
					while(reader.hasNextLine())
					{//while reader.hasNextLine open
						check_line = reader.nextLine();
						//check for perfect match
						if(check_line.contains(curr_search))
						{
							System.out.println("perfect match found");
							final_match = 100;
							file_to_open = curr_file_check.getPath();
							if(search == false)
							{
								return file_to_open;
							}
						}
						//check for partial matches
						else 
						{//else open	
							/****************************************************************************************************************************************
							 * This takes the string and shaves off the last letters one by one. So for example the string "test" becomes "tes" and "te" and so on. 
							 * After this is done, the 1st letter is removed and it starts again, so "est" to "es" and so on. This is done by creating a substring, 
							 * starting and ending depending on the 2 for loops. 
							 ****************************************************************************************************************************************/
							j = curr_search.length();
							for(i=0;i<curr_search.length();i++)
							{//for open
								for(j=curr_search.length();j>i;j--)
								{//for 2 open
									if(check_line.contains(curr_search.substring(i, j)))
									{//if open
										/****************************************************************************************************************
										*take current end-index of the string from current start-index of the string, to find no. of correct characters.
										*then divide this by the total length of the string and multiply by 100 to get match percentage
										******************************************************************************************************************/
										curr_match = (((float)j-(float)i)/curr_search.length() *100);
										if(curr_match > final_match)
										{
											System.out.println("new best match found");
											final_match = curr_match;
											if(final_match > file_match)
											{
												file_match = final_match;
												file_to_open = curr_file_check.getPath();
											}
										}
									}//if close
								}//for 2 close
							}//for close
						}//else close
					}//while reader.hasNextLine close
					reader.close();
					System.out.println("finished searching");
					
					//save the match percentage and filename to string, and save to set for later
					result_sort = (final_match + "% match in file " + curr_file_check.getName() + "\n");
					results_set.add(result_sort);
				}//try 2 close
				catch(FileNotFoundException e)
				{
					System.out.println("File not found");
				}
			}//files close
			/**************************************************************************
			 * sort all results from Highest match to lowest. All results saved to set.
			 * Results are reversed as with 90 vs 80, 8 is > than 9 and will by
			 * default print lowest value first. If there is 100% match, set to 
			 * final_results string before other results as 9 > 1, so 99.999%
			 * match would come before. Values less than 10 are found if the 2nd character
			 * in the string is a '.', and added to the small_sort array which is added last
			 * *************************************************************************/
			ArrayList<String> sorting = new ArrayList<String>(results_set);
			ArrayList<String> small_sort = new ArrayList<String>();
			System.out.println("sorting");
			Collections.sort(sorting);
			Collections.reverse(sorting);
			for(i=0;i<sorting.size();i++)
			{
				if(sorting.get(i).contains("100"))
				{
					final_result = final_result + sorting.get(i);
					sorting.remove(i);
					//i is reset to 0, as size of the set has shrunk
					i = 0;
				}
				if(sorting.get(i).charAt(1) == '.')
				{
					small_sort.add(sorting.get(i));
					sorting.remove(i);
				}
			}
			Collections.sort(small_sort);
			Collections.reverse(small_sort);
			for(i=0;i<sorting.size();i++)
			{
				final_result = final_result + sorting.get(i);
			}
			for(i=0;i<small_sort.size();i++)
			{
				final_result = final_result + small_sort.get(i);
			}
			
		}//try close
		catch(Exception e)
		{
			System.out.print("Directory not found");
		}
		
		if(final_result == "")
		{
			final_result = "No files were found. Bad Directory?";
		}
		
		System.out.println("Everythings done :D");
		if(search == true)
		{
			return final_result;
		}
		else
		{
			return file_to_open;
		}
	}//search close
}
