    try :
        list_users = ['/wp-content/plugins/fix/up.php']
        for ma in list_users :
            url = 'http://'+i+'/'+ma
            check = requests.get(url, timeout=3, headers=head).text
            if '<input type="file" name="fileToUpload" id="fileToUpload">' in check :
                print(fg+'vuln => '+i)
                open('vuln.txt','a').write(url+'\n')
            else:
                print(fr+'Not Vuln => '+i)
    except :
        pass
