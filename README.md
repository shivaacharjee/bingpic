# bingpic
Bingpic a php based simple web application which allow an user to enter keyword of his choice and get all the images related to the keywords into his server/local machine.

# How to use
Since Bingpic is using bing API to fetch images therfor you need one Bing search api (5000 queries a month). To get the api is simple, you just need a Microsoft account (refrence:http://www.bing.com/toolbox/bingsearchapi).
Once the key is generated, paste the key in the file "load_bing_image.php" and you are good to go. You can also paste the api in the frontend of the application itself instead of harcoading.

# The output files
All the images will be saved in the directory which the user will provide as a text input inside "d_i" directory. Once the fetching is over, the frontend will prompt you to download the images and an user can download with just one click.

#Multiple keyword search
User can search for the images of apple, mango and banana... and all images related to apple will get saved in "apple directory" and so on.


#note
1) You can use free or premium api.
2)The file "load_image_bing.php" was created to fetch images using google free api. But compare to Bing Google queries were too much limited. You are free to work in this fie. 
