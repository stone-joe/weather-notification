function Email_Details(source,eventdata)
%This functions asks the user for their email address, and uses a local
%function to make sure the email address is valid!
close all
Preferences_GUI = figure ('Visible', 'off', 'color', 'white');
%Move Gui to the center of the screen.
movegui(Preferences_GUI, 'center');
Figure_Handle3 = gcf;
set(Figure_Handle3, 'NumberTitle', 'off');
set(Preferences_GUI,'Name','Email Address','Resize','off');

Image_data3 = imread('Notification_Preferences.jpg', 'jpg');
axes
imagesc(Image_data3)
set(gca, 'YTick',[],'XTick',[], 'YTickLabel',[], ...
    'XTickLabel',[],'YColor', [1 1 1],'XColor', [1 1 1])
set(gcf,'MenuBar','none');

Preferences_Text = uicontrol('Style','text','Position',[80,30,435,20],...
    'String','Please enter a valid email address?',...
 'FontName', 'TimesNewRoman','FontSize',10,'FontWeight','Bold');

global Email_Address;
Email_Address = uicontrol ('Style', 'edit','Position',[140,10,180,20]);

Acknowledgement_Button = uicontrol('Style','pushbutton','String',...
    'Submit','Position',[340,10,120,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',@email_address); 


Go_Back_Button = uicontrol('Style','pushbutton','String',...
    'Back','Position',[40,450,120,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',...
    @Notification_Preferences);
set(Preferences_GUI,'Visible', 'on');

%Local Function to verify email address
    function email_address (source1,eventdata1)
        address = get(Email_Address, 'String');
        validity_check = strfind(address, '@');
        if isempty(validity_check)== 1
            Email_Details
        else
%Contact Server and upload email address to subscription list
            urlread(['http://notetech.host22.com/weather/add_email.php?email=',sprintf('%s',address)])
Daily_Notification
        end
    end

end 

