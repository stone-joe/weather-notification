function Notification_Preferences (source,eventdata)
%This function asks the user for their email preferences and redirects them
%to the email address interface, if they would like notifications via
%email.

close all
Notification_GUI = figure ('Visible', 'off', 'color', 'white');

%Move Gui to the center of the screen.
movegui(Notification_GUI, 'center');
Figure_Handle2 = gcf;
set(Figure_Handle2, 'NumberTitle', 'off');

%Set the name of the GUI
set(Notification_GUI,'Name','Notification Preferences','Resize','off');
Image_data2 = imread('Notification_Preferences.jpg', 'jpg');
axes
imagesc(Image_data2)

%Provide buttons for user preferences
Notification_Text = uicontrol('Style','text','Position',[85,30,435,20],...
    'String','Would you like to be notified via email?',...
 'FontName', 'TimesNewRoman','FontSize',10,'FontWeight','Bold');
Send_Email_Button = uicontrol('Style','pushbutton','String',...
    'Notify Me Via Email','Position',[150,10,120,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',@Email_Details);

No_Email_Button = uicontrol('Style','pushbutton','String',...
    'No','Position',[300,10,80,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',@Daily_Notification);

set(gca, 'YTick',[],'XTick',[], 'YTickLabel',[], ...
    'XTickLabel',[],'YColor', [1 1 1],'XColor', [1 1 1])
set(gcf,'MenuBar','none');

%Redirecting user to the previous window
global Season
Go_Back_Button = uicontrol('Style','pushbutton','String',...
    'Back','Position',[40,450,120,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',...
    {@Notification_Settings,Season});
set(Notification_GUI,'Visible', 'on');
end

