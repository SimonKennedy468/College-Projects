import string


# Function to search documents
def search(srch_wrd, file_dict):
    # everything to lowercase, and place in new dictionary so original is unaffected later
    srch_wrd = srch_wrd.lower()
    srch_wrd = srch_wrd.strip(string.punctuation)
    # move search criteria to set
    srch_set = srch_wrd.split()

    srch_set = set(srch_set)

    # make documents lowercase and remove all punctuation
    file_dict_search = {}
    for key in file_dict:
        file_dict_search[key] = file_dict[key].lower()
        file_dict_search[key] = file_dict_search[key].strip(string.punctuation)

    # reset key to 0
    file_found = 0
    set_key = 0
    matches = []

    #  Search the documents
    for set_key in srch_set:
        for key in file_dict_search:
            if set_key in file_dict_search[key]:
                matches.append(key) # Add key to match list
                file_dict_search[key] = ""  # Clear so document is not called multiple times
                file_found = 1

    # Clear unused dictionary
    file_dict_search.clear()
    if file_found == 0:
        print("No documents found matching your search")

    # Print the matches
    matches.sort()
    for key in range(len(matches)):
        print("Match found in Document:", matches[key])


# function to print document
def print_doc(key, file_dict):
    print(file_dict[key])



# Main Body of code

# Open document
document = open("ap_docs.txt", "r")
file_dict = {}
key = 0

# Move all lines to a dictionary
for line in document:
    wrd_line = line.strip()
    file_dict[key] = wrd_line
    key += 1

key = 1
new_string = ""
doc_start = 0
doc_count = 1

# Sort each line into its relevant document
while key < len(file_dict):
    if file_dict[key] == "<NEW DOCUMENT>":
        file_dict[doc_start] = "Document " + str(doc_count) + ">" + new_string # Enter document to dictionary
        doc_start = key
        doc_count += 1
        new_string = ""
    else:
        new_string = new_string + " " + file_dict[key]
        file_dict[key] = ""

    key += 1
# enter final document
file_dict[doc_start] = "Document " + str(doc_count) + ">" + new_string

file_dict_sorted = {}
sort_key = 1

# Sort into smaller dictionary
for key in file_dict:
    if file_dict[key] != "":
        file_dict_sorted[sort_key] = file_dict[key]
        sort_key += 1

# clear dictionary
file_dict.clear()


# Looping function for user input
while True:
    try:
        choice = int(input("What would you like to do?\n 1. Search for a document\n 2. Open a document\n 3. Exit the program\n>"))
        if choice == 1:
            srch = str(input("enter a string to search?\n>"))
            search(srch, file_dict_sorted)
        elif choice == 2:
            try:
                key = int(input("What document would you like to open?\n>"))
                print_doc(key, file_dict_sorted)
            except ValueError:
                print("Invalid Document entry")
        elif choice == 3:
            document.close()
            exit()
        else:
            print("Invalid input")
    except ValueError:
        print("Invalid input")
