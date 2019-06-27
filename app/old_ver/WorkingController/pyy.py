from glob import glob

pth ="C:/wamp64/www/Laravel-Boilerplate/app/Models/"
print(glob(pth+"*"))

# print(list(map(path.basename,iglob(path+"*Controller"))))


# print([path.basename(f) for f in  iglob(path+"*Controller")])
# php artisan make:controller filenameController
models = ['Branch', 
'BranchType', 'Category', 'City', 'Company', 'CompanyType', 'Counter', 'Country', 'Currency', 'DietaryPreference', 'Menu', 'MenuHasProduct', 'ModelHasPermission', 'ModelHasRole', 'PasswordReset', 'Permission', 'Product', 'ProductHasAddon', 'ProductUnit', 'Role', 'RoleHasPermission', 'Selection', 'SocialAuthentication', 'State', 'Unit', 'User', 'Variation']

di = {
    "Branch":"BranchType",
    "Menu":"Branch",
    "State":"Country",
    "City":"State",
    "Company":"CompanyType",
    "Branch":"Company",
    "MenuHasProducts":"Products",
    "MenuHasProducts":"Menu"
}

for index in models:
    current_file = index+"Controller.php"
    if(index in di):
        print(current_file)
        with open("StateController.php") as f:
            with open(current_file, "w") as f1:
                for line in f:
                    l1 = line.replace("State",index)
                    l1 = l1.replace("state",index.lower())
                    l1 = l1.replace("Country",di[index])
                    l1 = l1.replace("country",di[index].lower())
                    f1.write(l1)
    else:
        print(current_file)
        with open("StateController_diff.php") as f:
            with open(current_file, "w") as f1:
                for line in f:
                    l1 = line.replace("State",index)
                    l1 = l1.replace("state",index.lower())
                    f1.write(l1)