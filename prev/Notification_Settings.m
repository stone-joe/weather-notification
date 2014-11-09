function Notification_Settings (source,eventdata,Season)
%This function asks the user for their notification settings and guides
%them to the appropriate interface based on their choice.
%Close all previous figures and create a new GUI
close all
Season_GUI = figure ('Visible', 'off', 'color', 'white');
Figure_Handle1 = gcf;
set(Figure_Handle1, 'NumberTitle', 'off');

%Move Gui to the center of the screen.
movegui(Season_GUI, 'center');

%Set the name of the GUI and set the background based on the season
%determined with the help of the internal clock.
set(Season_GUI,'Resize','off');
 if (Season {2} == 1)
Image_data1 = imread('Spring.jpg', 'jpg');
set(Season_GUI,'Name','Spring Detected')
axes
imagesc(Image_data1)
elseif (Season{2} == 2)
Image_data1 = imread('Summer.jpg', 'jpg');
set(Season_GUI,'Name','Summer Detected')
axes
imagesc(Image_data1)
elseif (Season{2} == 3)
Image_data1 = imread('Fall.jpg', 'jpg');
set(Season_GUI,'Name','Fall Detected')
axes
imagesc(Image_data1)
elseif (Season{2} == 4)
Image_data1 = imread('Winter.jpg', 'jpg');
set(Season_GUI,'Name','Winter Detected')
axes
imagesc(Image_data1)
end
set(gca, 'YTick',[],'XTick',[], 'YTickLabel',[], ...
    'XTickLabel',[],'YColor', [1 1 1],'XColor', [1 1 1])

%Provide buttons for user settings
Seasonal_Text = uicontrol('Style', 'text', 'Position',[80,30,435,20], ...
    'String', ...
'Would you like a weather notification for today?',...
 'FontName', 'TimesNewRoman','FontSize',10,'FontWeight','Bold');

Daily_Notifications_Button = uicontrol('Style','pushbutton','String',...
    'Daily Notification','Position',[240,8,120,20], 'FontName', ...
    'TimesNewRoman','FontSize',10,'Callback',@Notification_Preferences);

% Future_Event_Notifications = uicontrol('Style','pushbutton','String',...
%     'Notifications for a Future Event','Position',[300,10,200,20], ...
%     'FontName','TimesNewRoman','FontSize',10,'Callback',...
%     @Day_of_Notification);

%Turn off Menubar and show resulting GUI.
set(gcf,'MenuBar','none');
set(Season_GUI,'Visible', 'on');
end

