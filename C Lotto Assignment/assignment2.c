/*Program to simulate a lottery game.
The program will use multiple functions to complete 
various tasks such as user input and error checks.
This program utalizes pointer notation.


Author: Simon Kennedy C19496436
Date of completion: 08/03/2020
Written in: Microsoft Visual Studio Code
Compiled in: gcc / mingW
*/


#include <stdio.h>


#define SIZE 6 //define size of picked number array
#define LOTTO 42 //define size of potential lotto numbers


int num_pick(int);//function to pick numbers
int num_pick_err(int[]);//function to ensure user dosent enter numbers more than once
int num_display(int[]);//function to display the picked numbers to the user
int sort(int[]);//function to sort numbers smallest to biggest
int check_nums(int[], int[]);//function to compare users numbers to winning numbers
int frequency(int []);//function to display the frequency of the numbers entered
int err_check();//function to check if user has entered their numbers
int exit_program(int);//function to confirm the user wants to exit the program



//main function to run the program
int main()
{//main start

    register int i;//i is placed in the register to improce effeciency

    int ans;//variable to check what function the user picked
    int pos;//variable to store position of 1st array, so that its corresponding point in array3 can be increased
    
    int user_input[SIZE] = {0,};//array to store users numbers
    int winning_nums[SIZE] = {1,3,5,7,9,11};//array to store winning numbers
    int freq_of_nums[LOTTO+1] = {0,};//array to store frequency of numbers
    
    int ans_check = 0;//variable to check if user has entered numebers
    int exit_confirm = 0;//variable to confirm exit
    int sort_check = 0;//variable to see if user has entered numbers

    short running = 1;//variable to keep program running
    

    while(running == 1)
    {//while start

        //print main menu
        printf("\n\n-----PRESS 1 TO ENTER NUMBERS-----\n-----PRESS 2 TO SEE THE NUMBERS YOU ENTERED-----\n-----PRESS 3 TO SORT YOUR NUMBERS-----\n");
        printf("-----PRESS 4 TO SEE IF YOU WIN-----\n-----PRESS 5 TO SEE HOW MANY TIMES NUMBERS HAVE BEEN ENTERED-----\n-----PRESS 6 TO EXIT-----\n\n");

        //waits for input from user and assigns input to ans
        scanf("%d",&ans);
        _flushall();//flush out enter keystrokes *NOTE* _flushall(); is used instead of flushall(); as the latter will cause a compiler error


        switch (ans)
        {//switch start

            //User enters numbers
            case 1:
                printf("\nPlease enter your 6 different numbers\n");


                for(i = 0; i < SIZE; i++)
                {//for start

                    /*the n'th element of the array is passed to the numpick function to 
                    read input and errorcheck. That element is kept as pos, and the pos'th element of the frequency
                    array is increased by one*/
                    *(user_input + i) = num_pick(*(user_input + i));

                }                    
                ans_check = num_pick_err(user_input);//numbers are checked to make sure none were entered more than once
                

                /*only enters numbers into the frequency
                array if they are valid entries*/
                if(ans_check == 1)
                {//if start
                    for(i = 0; i < SIZE; i++)
                    {//for start
                        pos = *(user_input + i);
                        *(freq_of_nums + (pos)) = *(freq_of_nums + (pos)) + 1; //increases element value by 1
                    }//for end
                }//if end

                
                break;

            //displays the last 6 numbers the user entered
            case 2:
                //error check if user has entered numbers
                if(ans_check == 0)
                {//if start
                    err_check();
                }//if end

                else
                {//else start
                    num_display(user_input);//array 1 passed to numdisplay function
                }//else end

                break;

            //sorts the users numbers smallest to largest
            case 3:
                //function to check if user has entered numbers
                if(ans_check == 0)
                {//if start
                    err_check();
                }//if end

                else
                {//else start
                    sort(user_input);//array 1 passed to sorting array
                }//else end

                break;

            //checks the users numbers against the winning numbers
            case 4:
                //function to check id user has entered numbers                
                if(ans_check==0)
                {//if 2 start
                    err_check();
                }//if 2 end

                //the users numbers and the winning numbers are passed to the check_nums function
                else
                {//else start
                    check_nums(user_input, winning_nums);
                }//else end

                break;

            //displays how often numbers have been entered
            case 5:
                //function to see if user has entered their numbers
                if(ans_check==0)
                {//if start
                    err_check();
                }//if end

                //user array and frequency array passed to frequency function
                else
                {//else start
                    frequency(freq_of_nums);
                }//else end
                break;

            //exits the program
            case 6:
                //passes confirmation variable to function
                exit_confirm=exit_program(exit_confirm);

                //only runs if user wants to exit
                if(exit_confirm==1)
                {
                    return 0;
                }
                break;


            default:
                printf("Invalid option entered\n");
        }//switch end
    }//while end
}//main end



//function for user to pick their numbers

int num_pick(int val)
{
//numpick start
    scanf("%d",&val);
    _flushall();


    //only return value if it is more than 0 or less than the bounds of the array
    if(val>0 && val<LOTTO + 1)
    {//if start
        return val;//returns value to user array
    }//if end


    else
    {//else start
        printf("you have entered an invalid input. Please enter a number between 1 and 42\n");//informs user of their error
        num_pick(val);//function calls itself to allow the user to re-enter their answer
    }//else end
//numpick end
}


//function to check if user entered any number more than once
int num_pick_err(int user[])
{
    register int i;//i is placed into the register to improve effeciency
    register int j;//j is placed into the register to improve effeciency
    int err=0;//variable to store the error check result


    /*This counts the number of times an identical number appears
    due to the nature of the 2 for loops, it will always find 
    some identical numbers when i and j equal each other. if there are more than 5 identical 
    numbers found, then there is an identical number entered, and the inputs are rejected*/
    for(i = 0; i < SIZE; i++)
    {//for 1 start
        for(j = 1; j < SIZE; j++)
        {//for 2 start
            if(*(user + i) == *(user + j))
            {//if start
                err++;
            }//if end
        }//for 2 end
    }//for 1 end


    //if an error was found
    if(err > 5)
    {//if start
        printf("\nYou have entered a number more than once. Please enter 6 different numbers\n");
        return 0;
    }//if end


    //if no errors were found
    else
    {//else start
        return 1;//returns one to show valid answers were entered
    }//else end
}



//function to display entered numbers
int num_display(int array[])
{//numdisplay start
    register int i;//i is placed into the register to imporve frequency

    printf("\nYou have entered:\n");

    for(i = 0; i < SIZE; i++)
    {//for start
        printf("%d\n",*(array + i));
    }//for end
}//numdisplay end



//function to use bubble sort
int sort(int sort_arr[])
{//sort start
    register int i;//i is placed into the register to improve efficency
    register int j;//j is placed into the register to imporce efficenty


    int temp;//temp variable for sorting algrothym
    for(i = 0; i < SIZE; i++) 
    {//for 1 start
        for(j = 0; j < SIZE-i-1 ;j++) //while j is less than one less then the max of the array, as the algrothim will ensure the last number is already sorted
        {//for 2 start
            if(*(sort_arr + j) > *(sort_arr + (j + 1)))//if the current number is bigger than the next number in the array
            {//if start
                temp = *(sort_arr + j);//current number kept in temp
                //numbers are swapped
                *(sort_arr + j) = *(sort_arr + (j + 1));
                *(sort_arr + (j + 1)) = temp;
            }//if end
        }//for 2 end
    }//for 1 end

printf("\n\nNumbers sorted smallest to largest. Press 2 to view them.");

}//sort end



//function to check users numbers against winning numbers
int check_nums(int user[SIZE], int win[SIZE])
{//check_nums start
    register int i;//i is placed in the register to improve efficency
    register int j;//j is placed in the register to improve efficeny
    int win_counter = 0;//wincounter reset to 0 each time the function is called, to ensure accuaracy




    /*The users numbers are checked against the winning numbers
    for every match, the win counter is increased by 1*/
    for(i = 0; i < SIZE; i++)
    {//for 1 start
        for(j = 0; j < SIZE; j++)
        {//for 2 start
            if(*(user + i) == *(win + j))
            {//if start
                win_counter++;
            }//if end
        }//for 2 end
    }//for 1 end

    printf("\nYou matched %d numbers\n",win_counter);

    //if 3 numbers match
    if(win_counter==3)
    {//if start
        printf("You have won a cinema pass!\n");
    }//if end


    //if 4 numbers match
    else if(win_counter==4)
    {//else if start
        printf("You have won a Weekend away!\n");
    }//else if end


    //if 5 numbers match
    else if(win_counter==5)
    {//else if start
        printf("You have won a New Car!\n");
    }//else if end


    //if 6 numbers match
    else if(win_counter==6)
    {//else if start
        printf("You have won the Jackpot!\n");
    }//else if end


    //if less than 3 numbers match
    else
    {//else start
        printf("Sorry, You did not win anything today. Please try again.\n");
    }//else end
}//check_nums end



//function to count frequency of numbers
int frequency(int freq[])
{//frequency start
    register int i;//i is placed in the register to imporve effeciency


    /*cycles through the frequency array. if a number
    has been entered i.e its corresponding element
    isnt 0, it is displayed alongside its frequency*/
    for(i = 0; i < LOTTO + 1; i++)
    {//for start
        if(*(freq + i) != 0)
        printf("%d has been entered %d times\n",i,*(freq + i));
    }//for end
}//frequency end



//function to check if user entered numbers
int err_check()
{//errcheck start
    printf("You have not yet entered any numbers / Entered invalid numbers. Please Enter some numbers by pressing 1\n");
}//errcheck end



//function to confirm exit
int exit_program(int exit_confirm)
{//exit_program start
    char confirm;//variable to confirm exit

    printf("Are you sure you want to exit [Y/N]?\n");
    scanf("%c",&confirm);
    _flushall();//flushes out enter keystrokes


    //if user wants to exit
    if(confirm == 'y' || confirm == 'Y')
    {//if start
        exit_confirm = 1;//confirmation set to 1
        return exit_confirm;
    }//if end


    //if user dosent want to exit
    else if(confirm == 'n' || confirm == 'N')
    {//else if start
        printf("Returning to main menu...\n\n");
    }//else if end


    //if user has invalid unput
    else
    {//else start
        printf("Invalid entry\n");
    }//else end
}//exit_program end