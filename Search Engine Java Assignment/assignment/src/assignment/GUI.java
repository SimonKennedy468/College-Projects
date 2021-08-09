package assignment;

import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.IOException;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;


public class GUI extends JFrame implements ActionListener, MouseListener, FileProcessor
{
	JButton search;
	JButton open_file;
	JPanel top_panel;
	JPanel mid_panel;
	JPanel bottom_panel;
	JLabel search_space_label;
	JLabel search_term_label;
	JTextField tf_search_term;
	JTextField tf_search_space;

	
	
	GUI(String title)
	{
		setSize(900,300);
		setLayout(new GridLayout(3,1));
		
		//panels
		top_panel = new JPanel(new FlowLayout());
		mid_panel = new JPanel(new FlowLayout());
		bottom_panel = new JPanel(new FlowLayout());
		
		//button
		search = new JButton("Search");
		search.setToolTipText("Press the button to search");
		search.addActionListener(this);
		
		open_file = new JButton("Search and open file with best Match");
		open_file.setToolTipText("Press the button to search through the files, and open the file with the best match in notepad");
		open_file.addActionListener(this);
		

		
		//Textfield
		tf_search_term = new JTextField();
		tf_search_term.setColumns(15);
		tf_search_term.addActionListener(this);
		
		tf_search_space= new JTextField();
		tf_search_space.setColumns(15);
		tf_search_space.addActionListener(this);
		
		//labels
		search_space_label = new JLabel("Enter the Directory here.");
		search_term_label = new JLabel("Enter search term here.");
		
		//add everything to panels
		top_panel.add(search_space_label);
		top_panel.add(tf_search_space);
		
		mid_panel.add(search_term_label);
		mid_panel.add(tf_search_term);
		
		bottom_panel.add(search);
		bottom_panel.add(open_file);
		add(top_panel);
		add(mid_panel);
		add(bottom_panel);
		
		setVisible(true);
		
	}

	@Override
	public void mouseClicked(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mousePressed(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseReleased(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseEntered(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseExited(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void actionPerformed(ActionEvent e) 
	{
		if(e.getSource() == search)
		{
			String search_term;
			String search_space;
			
			if(tf_search_term.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "You havent searched anything");
			}
			else
			{
				search_term = tf_search_term.getText();
				if(tf_search_space.getText().equals(""))
				{
					search_space = "C:/";
				}
				else
				{
					search_space = tf_search_space.getText();
					//replace escape characters with forward-slash
					removeEscapeChar(search_space);
				}
				JOptionPane.showMessageDialog(this, FileProcessor.searchForTerm(search_term, search_space, true));
			}
		}
		else if(e.getSource() == open_file)
		{
			String search_term;
			String search_space;
			String open = "";

			if(tf_search_term.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "You havent searched anything");
			}
			
			else
			{			
				search_term = tf_search_term.getText();
				if(tf_search_space.getText().equals(""))
				{
					search_space = "C:/";
				}
				else
				{
					search_space = tf_search_space.getText();
					//replace escape characters with forward-slash
					search_space = removeEscapeChar(search_space);
				}
				open = FileProcessor.searchForTerm(search_term, search_space, false);
				open = removeEscapeChar(open);
				
				if(open == "")
				{
					JOptionPane.showMessageDialog(this, "No results found");
				}
				else
				{
					//Taken from https://stackoverflow.com/questions/3487149/how-to-open-the-notepad-file-in-java
					ProcessBuilder pb = new ProcessBuilder("Notepad.exe", open);
					try 
					{
						pb.start();
					} 
					catch (IOException e1) 
					{
						e1.printStackTrace();
					}
					//end of what was taken
				}
			}
			
		}
	}
	
	//method to convert escape character to forward slash
	public static String removeEscapeChar(String curr_string)
	{
		int i;
		for(i=0;i<curr_string.length();i++)
		{
			if(curr_string.charAt(i) == '\\' )
			{
				curr_string.replace(curr_string.charAt(i), '/');
			}
		}
		return curr_string;
	}
}
