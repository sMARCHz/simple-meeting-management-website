This is my simple project that code without framework just only pure php, html, css, js, sql.  
The web use for simple meeting that you can easily use.

## Database structure <br>
**Form of database of this project is fixed. you can check it out in exampleDB.sql**

1. AllMeeting    contain table of all meetings
	- MeetingID     is unique id of each meeting
    - Topic 
	- Date
	- Time <br>
	**!!Warning: In my code meeting consider only date, so time is not so important to it!!** 
	- Host          who is create the meeting
	- Place   
	- Doc_Link      contain link to document of meeting.
	- Conclusion    contain link to summary of meeting. 

2. AllUser    contain table of all users
	- UserID        is unique id of each user
	- email
	- password <br>
	**In my code we need to use real email and password because of we have email notification but my mailerlibrary is still error so it can't actually send to your email**
	- Name          is First name
	- Last_Name 
	- Position
	- Gender
	- Age
	- Rank          is the status of people to use this web. ADMIN is person that control that meeting. User is person that only join in that meeting. **ADMIN can be USER in other meeting**

3. Message    contain table of  message data that's going to show you in the dashboard. for example your meeting's chairman is denying the meeting, etc.
	- SenderID
	- ReceiverID
	- SendingTime
	- Head
	- MSID
	- MeetingID
	- Topic
4. SelectedMeeting    contain table that tell who's in each meeting. 
	- MeetingID
	- SelectedID
	- UserID
	- Priority      contain 3 rank( A=chairman, B=director, C=paticipant : you can change it if you want and change in the code to like user.php or admin.php)
	- MeetConf      contain 3 number ( -1 = user decline to join that meeting, 0 = waiting user to confirm, 1 = user accept to join that meeting.


You can't use it to use in commercial things without permission.
Thanks

Nattanon Chansamakr
	
