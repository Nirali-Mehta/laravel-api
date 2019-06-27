import os 
import shutil
list2 = ['Category', 'City', 'Company', 'CompanyType', 'Counter', 'Country', 'Currency', 'DietaryPreference', 'Menu', 'MenuHasProduct', 'Permission', 'Product', 'ProductHasAddon', 'ProductUnit', 'Role', 'Selection', 'State', 'Unit', 'User', 'Variation']

for i in list2:
    # str = i+"Update.php"
    # f= open(str, 'w')

    # content = "<?php \n namespace App\Api\V1\Requests;\nuse Dingo\Api\Http\FormRequest;\nclass "+ i +"Update extends FormRequest"
    # f.write(content)
    # f.close()
    # src=i+"Store.php"
    dst=i+"Controller.php"
    # src2=i+"Store"
    # dst2=i+"Update" 

    line1 = "update(Request"
    line2 = "update("+i+"Update"
    # shutil.copy(src,dst)

    s = open(dst).read()
    s = s.replace(line1, line2)
    f = open(dst, 'w')
    f.write(s)
    f.close()

    