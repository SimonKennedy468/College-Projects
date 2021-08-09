/*

TO DO

CAST STRUCTUER TO CHECK FUNCTION WITH POINTERS
CONVERT FUNCTIONS TO POINTERS
BUG TEST FOR
    DECIMAL
    CHAR
    STRING 
REPEATING OPERATIONS
PERFORMING OPERATIONS EARLY
CODE CLEANUP
COMPILE TEST
EXIT FUNCTION


*/
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

#define SIZE 4

struct code_counter{
    int correct_code;
    int wrong_code;
};

int encryption(int[]);
int menu(int[]);
int enter_nums(int[]);
int rand_num_gen(int[]);
int check(int[], int[], struct code_counter);
int decrypt(int[]);
int num_counter(struct code_counter);

int main()
{
    register int i;

    int user_nums[4];

    static int access_code[4];

    access_code[0]=4;
    access_code[1]=5;
    access_code[2]=2;
    access_code[3]=3;


    int ans;
    short enter_nums_check;
    short running = 1;
    short encrypt_check = 0;
    short decrypt_check = 0;
    short num_entered = 0;


    struct code_counter counter={0,
                                 0 
                                };



    while(running==1)
    {
        printf("\npick an option:\n1 pick_nums/rand nums\n2 encrypt\n3 check nums\n4 decrypt\n5 no of correct enteries\n6 exit\n");

        scanf("%d",&ans);
        _flushall();

        switch(ans)
        {
            case 1:
            {
                printf("Press one to enter a number yourself, or 2 to randomly generate a number\n");
                scanf("%d",&enter_nums_check);

                if(enter_nums_check == 1)
                {
                    enter_nums(user_nums);
                }

                else
                {
                    rand_num_gen(user_nums);
                }

                num_entered = 1;
                encrypt_check = 0;
                break;
            }

            case 2:
            {
                if(num_entered == 1 && encrypt_check == 0)
                {
                    encryption(user_nums);
                    encrypt_check=1;
                }

                else if(encrypt_check == 1)
                {
                    printf("\nyou have already encrypted your numbers\n");
                }
                else
                {
                    printf("\nYou have not entered a number yet. Please enter a number or randomly generate one by pressing 1 on your keyboard\n");
                }
                
                break;
            }

            case 3:
            {
                if(encrypt_check == 1)
                {
                    check(user_nums, access_code, counter);
                }

                else if(num_entered!=1)
                {
                    printf("\nYou have not yet entered any numbers. Press one on you keyboard to enter your numbers");
                }

                else 
                {
                    printf("\nYou have not encrypted your numbers. Please encrypt your nunmbers by pressing 2 on your keyboard\n");
                }
                break;
            }

            case 4:
            {
                if(encrypt_check == 1)
                {
                    decrypt(user_nums);
                    encrypt_check = 0;
                }

                else if(encrypt_check !=1)
                {
                    printf("\nYou have not encrypted your numbers yet. Please encrypt your numbers by pressing 2 on your keyboard\n");
                }

                else 
                {
                    printf("\nYou have not encrypted your numbers. Please encrypt your nunmbers by pressing 2 on your keyboard\n");
                }
                
                break;
            }

            case 5:
            {
                if(num_entered == 1)
                {
                    num_counter(counter);
                }
                else
                {
                    printf("\nYou have not yet entered any numbers. Please press 1 on your keyboard to enter or randomly generate numbers\n");
                }
                
                break;
            }

            case 6:
            {
                return 0;
            }
        }
    }

    //encrypt nums

    getchar();
    return 0;
}


int encryption(int user_nums[])
{
    register int i;
    int temp;

    temp = user_nums[0];
    user_nums[0]=user_nums[2];
    user_nums[2]=temp;

    temp = user_nums[1];
    user_nums[1]=user_nums[3];
    user_nums[3]=temp;

    for(i=0;i<4;i++)
    {
        user_nums[i]=user_nums[i]+1;

        if(user_nums[i]==10)
        {
            user_nums[i]=0;
        }
    }

    for(i=0;i<4;i++)
    {
        printf("%d",user_nums[i]);
    }

}


int enter_nums(int user_nums[])
{
    register int i;
 
    printf("please enter your four number passcode:\n");

    for(i=0;i<4;i++)
    {
        scanf("%d",&user_nums[i]);
        _flushall();
    }
}

int rand_num_gen(int user_nums[])
{
    register int i;

    srand(time(0));
    
    for(i=0;i<4;i++)
    {
        user_nums[i]=rand() % 9;
    }
}

int check(int user_nums[], int access_code[], struct code_counter times)
{
    printf("\n\ncomparing numbers...\n\n");
    if(user_nums[0]==access_code[0] && access_code[1]==access_code[1] && user_nums[2]==access_code[2] && user_nums[3]==access_code[3])
    {
        printf("\nnumbers match\n");
        times.correct_code++;
    }
    

    else
    {
        printf("\nnumbers do not match\n");
        times.wrong_code++;
    }
}

int decrypt(int user_nums[])
{
    register int i;
    int temp;

    temp = user_nums[0];
    user_nums[0]=user_nums[2];
    user_nums[2]=temp;

    temp = user_nums[1];
    user_nums[1]=user_nums[3];
    user_nums[3]=temp;

    for(i=0;i<4;i++)
    {
        user_nums[i]=user_nums[i]-1;

        if(user_nums[i]==-1)
        {
            user_nums[i]=9;
        }
    }

    for(i=0;i<4;i++)
    {
        printf("%d",user_nums[i]);
    }

}

int num_counter(struct code_counter times)
{
    printf("\n\nthe code has been correct %d times",times.correct_code);
    printf("\nthe code has been incorrect %d times\n\n\n",times.wrong_code);
}