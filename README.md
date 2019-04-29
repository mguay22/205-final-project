# Bill Buddy
### Contributors: 
1. Josh Childs 
2. Michael Guay
3. Lan Ho
4. Ziyin Xu


### For Graders:

Our final project is a web application that allows individuals in an apartment or house to share bills with one another in a sleek and easy to understand UI. 

### Our Web App, Bill Buddy, is hosted here. 

[Bill Buddy](https://jhchilds.w3.uvm.edu/final_proj/ "Login")

To make your grading easier you can navigate our site this way to view as much as our functionality as possible:

1. Navigate to [Bill Buddy](https://jhchilds.w3.uvm.edu/final_proj/ "Login")
2. Sign up for new account by clicking sign-up link.
3. Fill in details and click register button.

4.  (*Two Options*) **1)** Register with new address (this will give your user "admin" privelages, such as Adding and Deleting Bills) 
 **2)** Register with existing address. We have a sample group created with House Code 1. You will be able to see these bills as a "standard" user (can not add or delete bills). 


# Code
Our code will be submitted on Blackboard with links to this github repository as well as a link to the [Web App](https://jhchilds.w3.uvm.edu/final_proj/ "Login").

For security, we will not be submitting our database passwords. If you would like to connect to your own database, add your own passwords and usernames in lib/pass.php and lib/constants.php respectively using your given [UVM MySQL account](https://webdb.uvm.edu/account/ "WebDB UVM").

## Logical Flow of the System

1. User navigates to [Bill Buddy](https://jhchilds.w3.uvm.edu/final_proj/ "Login")

![alt text][index]

[index]: http://jhchilds.w3.uvm.edu/final-screenshots/index1.png "Bill Buddy Index"

2. This is our sign-in page, as well as our index.
3. From here you can login, or register a new user. 

![alt text][register]

[register]: http://jhchilds.w3.uvm.edu/final-screenshots/register2.png "Bill Buddy Registration"

4. Either way, this will call upon the Auth class (**Auth.php**)

![alt text][new]

[new]: http://jhchilds.w3.uvm.edu/final-screenshots/address3.png "Bill Buddy Registration"

5. The Auth class defines the php session variable for all users, existing or newly created.

![alt text][existing]

[existing]: http://jhchilds.w3.uvm.edu/final-screenshots/address3new.png "Bill Buddy Registration"

![alt text][existing2]

[existing2]: http://jhchilds.w3.uvm.edu/final-screenshots/address4existing.png "Bill Buddy Registration"

6. Auth.php also selects and inserts user information to our **MySQL** database.

7. After successful user authentication, all users are redirected to **dashboard.php**.

![alt text][dashboard]

[dashboard]: http://jhchilds.w3.uvm.edu/final-screenshots/dashboard5.png "Bill Buddy Registration"

8. The Dashboard retrieves and prints all existing bills associated with the current user's address, specifically their addressId.
9. The **addressId** connects all users within the same group (apartment, house, unit etc...)
10. (Admin Only) From the dashboard, group admins can access **addBill.php** from the sidebar nav. 
11. **addBill.php** allows admins to create new bills for their group. 

![alt text][addbill]

[addbill]: http://jhchilds.w3.uvm.edu/final-screenshots/addBill6.png "Bill Buddy Registration"

12. These bills will be displayed on the dashboards of every user in the associated group reguardless of the status of the user.
