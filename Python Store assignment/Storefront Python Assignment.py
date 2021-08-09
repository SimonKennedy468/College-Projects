# Imported for string.puntuation function
import string


# Shopping cart class
class ShoppingCart:
    '''This class is used to store the items the user wishes to buy, the total cost of
    Those items, and the cost of shipping (10%)'''
    def __init__(self,):

        # class vars
        self.items = {"CPU": 0, "GPU": 0, "RAM": 0, "CASE": 0}
        self.total = 0
        self.shipping = 0

    # Print items function
    # to end of list
    def print_items(self):
        '''This function is used to print the items in the cart. The __str__ method was not
        used as it would add the word "None" to the end of the list of items. Instead,
        it adds all items with a quantity above 0 to a list as a string, with the punctuation
        removed.'''
        cart_list = []
        if self.items["CPU"] > 0:
            cart_list.append(("CPU x " + str(self.items["CPU"])))
        if self.items["GPU"] > 0:
            cart_list.append(("GPU x " + str(self.items["GPU"])))
        if self.items["RAM"] > 0:
            cart_list.append(("RAM x " + str(self.items["RAM"])))
        if self.items["CASE"] > 0:
            cart_list.append(("Case x " + str(self.items["CASE"])))

        for i in range(len(cart_list)):
            print(cart_list[i].strip(string.punctuation))

    def __str__(self):
        '''The __str__ method is used to print the shipping cost to the 2nd decimal point,
        otherwise it is printed with the full value.'''
        return '{:.2f}'.format(self.shipping)


# Class to store available items for sale

# Customer class.
# inherits from Shopping Cart
class Customer(ShoppingCart):
    '''This class is used to Represent the customer. It inherits from the ShoppingCart
    Class, and contains the default customer type "Bargain Hunter".'''
    def __init__(self,):
        self.cust_type = "Bargain Hunter"
        ShoppingCart.__init__(self,)

    def __str__(self):
        '''This Return the customer type and informs the user as to what items they can
        access. '''
        return 'You are a {}. You can access most items'.format(self.cust_type)

    # function to add item to shopping cart
    def add_item(self, current_item, quant, item_check):
        '''This function is used to add an item to the shopping cart.
        It passes the current item object, the quantity to be added and the name
        of the item. It calculates the total and shipping, and returns it to the shopping cart.'''
        if item_check == "CPU":
            self.items["CPU"] = self.items["CPU"] + quant
            self.total = self.total + (current_item.price * quant)
            self.shipping = (self.total / 100) * 10

        if item_check == "GPU":
            self.items["GPU"] = self.items["GPU"] + quant
            self.total = self.total + (current_item.price * quant)
            self.shipping = (self.total / 100) * 10

        if item_check == "RAM":
            self.items["RAM"] = self.items["RAM"] + quant
            self.total = self.total + (current_item.price * quant)
            self.shipping = (self.total / 100) * 10

        if item_check == "Case":
            self.items["CASE"] = self.items["CASE"] + quant
            self.total = self.total + (current_item.price * quant)
            self.shipping = (self.total / 100) * 10

        return self.total, self.shipping

    # Function to remove items
    def remove_item(self, index, quant):
        '''This function is used to remove items from the cart. It passes the index of
        the item, and the quantity to remove. It recalculates teh total and shipping,
        and removes the item from the cart.'''
        curr_item = index
        if curr_item == "CPU":
            self.total = self.total - (CPUs.price * quant)
            self.shipping = (self.total / 100) * 10
            self.items["CPU"] = self.items["CPU"] - quant

        if curr_item == "GPU":
            self.total = self.total - (GPUs.price * quant)
            self.shipping = (self.total / 100) * 10
            self.items["GPU"] = self.items - quant

        if curr_item == "RAM":
            self.total = self.total - (RAM.price * quant)
            self.shipping = (self.total / 100) * 10
            self.items["RAM"] = self.items["RAM"] - quant

        if curr_item == "Case":
            self.total = self.total - (Case.price * quant)
            self.shipping = (self.total / 100) * 10
            self.items["CASE"] = self.items["CASE"] - quant

        return self.total, self.shipping


# Class for Loyal customer's
# Inherits from Customer class
class LoyalCustomer(Customer):
    '''This Class is used to store info for loyal customers. IT contains a variable
    "self.loyal" to check if user can access exclusive items.'''
    def __init__(self, loyal):
        Customer.__init__(self,)

        self.loyal = loyal
        self.cust_type = "Loyal Customer"

    def __str__(self):
        '''This Return the customer type and informs the user as to what
        items they can access.'''
        return 'You are a {}. You can access all items'.format(self.cust_type)


# Class to store available items for sale
class Items():
    '''Class to contain information on items such as name, stock and price.'''
    def __init__(self, name, stock, price, ):
        self.name = name
        self.stock = stock
        self.price = price

    # Function to add stock if an item is removed from the cart
    def add_stock(self, quantity):
        '''This function passes the quantity to be added, then increases the
        stock of that item'''
        self.stock += quantity

    # Function to remove stock after an item is placed in the cart
    def remove_stock(self, quantity):
        '''This function recives the quantity to be removed, then
        decreases the stock of that item. There is an extra check
        if the stock dips below zero, it is set to zero'''
        self.stock -= quantity
        if self.stock <= 0:
            self.stock = 0

    # string method to print items
    def __str__(self):
        '''Returns item information from the class'''
        return 'Name: {}, Inventory: {}, Price: {}'.format(self.name, self.stock, self.price)

    # Operator overload for comparison
    def __lt__(self, other):
        '''This function uses operator overloading to compare the stock to the
        quantity variable'''
        if self.stock < other:
            return True
        else:
            return False

    # Operator overload for comparison
    def __gt__(self, other):
        '''This function uses operator overloading to compare the stock to the
        quantity variable'''
        if self.stock > other:
            return True
        else:
            return False


def test():
    '''Function to test out classes and functions.
    it runs class functions to demonstrate stock changing,
    items being removed, and checkout'''
    curr_cust = LoyalCustomer(1)
    for i in range(len(items_list)):
        print(items_list[i])
    for j in range(len(exclusive_item_dict)):
        print(exclusive_item_dict[j])

    print("Adding 3 CPU's and 2 GPU's\n")
    quantity = 3
    curr_cust.add_item(CPUs, quantity, "CPU")
    CPUs.remove_stock(quantity)
    quantity = 2
    curr_cust.add_item(GPUs, quantity, "GPU")
    GPUs.remove_stock(quantity)
    for i in range(len(items_list)):
        print(items_list[i])
    for j in range(len(exclusive_item_dict)):
        print(exclusive_item_dict[j])

    print("removing 2 CPU's\n")
    quantity = 2
    curr_cust.remove_item("CPU", quantity)
    CPUs.add_stock(quantity)
    for i in range(len(items_list)):
        print(items_list[i])
    for j in range(len(exclusive_item_dict)):
        print(exclusive_item_dict[j])

    print("\nCurrent cart")
    curr_cust.print_items()
    print("Your total is:", curr_cust.total)
    print("Checkout")
    print("Subtotal: ", curr_cust.total)
    print("Shipping: ", curr_cust.__str__())
    print("Total:", curr_cust.shipping + curr_cust.total)
    print("Thank you for your purchase\n")
    exit()


# main body
# Initialise available items
CPUs = Items("CPU", 5, 499)
GPUs = Items("GPU", 3, 699)
RAM = Items("RAM", 10, 399)
Case = Items("Case", 5, 99)
cust_created = 0
no_items = 0

items_list = [CPUs, GPUs, RAM]
exclusive_item_dict = [Case]

# Looping Main
while True:
    try:
        usr_input = int(input("\n1: Create a customer\n2: List Products\n3: Add/Remove Products\n4: See current shopping cart\n5: Checkout\n6: Test Program\n"))
        # User creates a customer
        if usr_input == 1:
            cust_input = int(input("1 for loyal, 2 for bargain\n"))
            if cust_input == 1:
                curr_cust = LoyalCustomer(1)
                print(curr_cust.__str__())
                cust_created = 1
            elif cust_input == 2:
                curr_cust = Customer()
                cust_created = 1
                print(curr_cust.__str__())
            else:
                print("bad input")



        # User lists available items
        elif usr_input == 2:
            if cust_created == 1:
                i = 0
                j = 0
                for i in range(len(items_list)):
                    print(items_list[i])

                # check if customer is loyal
                try:
                    if curr_cust.loyal == 1:
                        for j in range(len(exclusive_item_dict)):
                            print(exclusive_item_dict[j])
                except AttributeError:
                    None
            else:
                print("no customer created")



        # User wishes to add/remove an item
        elif usr_input == 3:
            if cust_created == 1:
                # user selects whether to add or remove an item from their cart
                add_or_remove = int(input("Add(1) or remove(2)?\n"))
                if add_or_remove == 1:
                    # User selects item to add or remove
                    curr_item = str(input("Which item would you like? CPU, GPU, RAM or a Case?\n"))
                    if curr_item == "CPU":
                        quantity = int(input("How many would you like\n"))
                        if CPUs.stock >= quantity:
                            curr_cust.add_item(CPUs, quantity, curr_item)
                            CPUs.remove_stock(quantity)
                        else:
                            print("not enough stock")

                    if curr_item == "GPU":
                        quantity = int(input("How many would you like?\n"))
                        if GPUs.stock >= quantity:
                            curr_cust.add_item(GPUs, quantity, curr_item)
                            GPUs.remove_stock(quantity)
                        else:
                            print("not enough stock")

                    if curr_item == "RAM":
                        quantity = int(input("How many would you like?\n"))
                        if RAM.stock >= quantity:
                            curr_cust.add_item(RAM, quantity, curr_item)
                            RAM.remove_stock(quantity)
                        else:
                            print("not enough stock")

                    if curr_item == "Case":
                        try:
                            if curr_cust.loyal == 1:
                                quantity = int(input("How many would you like?\n"))
                                if Case.stock > quantity:
                                    curr_cust.add_item(Case, quantity, curr_item)
                                    Case.remove_stock(quantity)
                                else:
                                    print(" out of stock")
                        except AttributeError:
                            print("This item is exclusive to loyal customers")


                # user wishes to remove item
                if add_or_remove == 2:
                    print("Your cart:",)
                    # Only print items in Cart
                    if curr_cust.items["CPU"] > 0:
                        print("CPU x ", curr_cust.items["CPU"])

                    elif curr_cust.items["GPU"] > 0:
                        print("GPU x ", curr_cust.items["GPU"])

                    elif curr_cust.items["RAM"] > 0:
                        print("RAM x ", curr_cust.items["RAM"])

                    elif curr_cust.items["CASE"] > 0:
                        print("Case x ", curr_cust.items["CASE"])

                    else:
                        print("Empty")
                        no_items = 1

                    if no_items == 0:
                        curr_key = str(input("What item to remove? Enter name of item\n"))
                        if curr_cust.items[curr_key] == 0:
                            print("You dont have that item")
                        else:
                            quantity = int(input("how many to remove\n"))
                            # use __lt__ method
                            if curr_cust.items[curr_key] <= quantity:
                                curr_cust.remove_item(curr_key, quantity)
                            else:
                                print("You dont have that many")
                            # Replenish stock
                            if curr_key == "CPU":
                                CPUs.add_stock(quantity)

                            if curr_key == "GPU":
                                GPUs.add_stock(quantity)

                            if curr_key == "RAM":
                                RAM.add_stock(quantity)

                            if curr_key == "Case":
                                Case.add_stock(quantity)
                    no_items = 0

            else:
                print("no customer created")



        elif usr_input == 4:
            if cust_created == 1:

                if curr_cust.total == 0:
                    print("Your cart is empty")
                else:
                    curr_cust.print_items()
                    print("Your total is:", curr_cust.total)

            else:
                print("no customer created")



        elif usr_input == 5:
            if cust_created == 1:

                if curr_cust.total == 0:
                    print("your cart is empty")
                else:
                    curr_cust.print_items()
                    print("Subtotal: ", curr_cust.total)
                    print("Shipping: ", curr_cust.__str__())
                    print("Total:", curr_cust.shipping + curr_cust.total)
                    checkout_ans = str(input("Are you sure you want to check out?Y/N\n"))
                    checkout_ans.upper()
                    if checkout_ans == 'Y':
                        print("Thank you for your purchase\n")
                        exit()
                    elif checkout_ans == 'N':
                        print("returning to menu")
                    else:
                        print("bad_input")

            else:
                print("no customer created")



        # Function to test software
        elif usr_input == 6:
            test()

        else:
            print("bad input")

    # Exceptions
    except ValueError:
        print("bad input")
    except KeyError:
        print("bad input")
