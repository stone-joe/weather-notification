%% Get data from internal clock and sort out the information.
clear all
close all
clc
Internal_Clock = clock;
[ Year, Month, Day, Time ] = Clock_Data(Internal_Clock);

%% Call a function to find out season based on date
global Season; %Being used by multiple functions.
Season = Find_Season (Month, Day);
%% Call GUI with a preview of the program

%Start by initializing a GUI but keeping it invisible.
Weather_GUI = figure ('Visible', 'off', 'color', 'white');

%Move Gui to the center of the screen.
movegui(Weather_GUI, 'center');

%Set the name of the GUI
set(Weather_GUI,'Name','Drastic Weather Change Detector','Resize','off');
Figure_Handle = gcf;

%Read in the desired background image and put it in the GUI.
Image_data = imread('4Seasons.jpg', 'jpg');
axes
imagesc(Image_data)

%Fix some figure frame
set(gca, 'YTick',[],'XTick',[], 'YTickLabel',[], ...
    'XTickLabel',[],'YColor', [1 1 1],'XColor', [1 1 1])
set(Figure_Handle, 'NumberTitle', 'off');

%Put in the Welcome message
Welcome_Text = uicontrol('Style', 'text', 'Position',[80,30,435,20], ...
    'String', ...
'Welcome to the Drastic Weather Detector! Click Enter to continue!',...
 'FontName', 'TimesNewRoman','FontSize',10,'FontWeight','Bold');

%Create push button and use it to call the next screen
Welcome_Button = uicontrol('Style','pushbutton','String', 'Enter',...
    'Position',[250,10,60,20], 'FontName', 'TimesNewRoman',...
    'FontSize',10,'Callback',{@Notification_Settings,Season});

%Remove menu bar from image
set(gcf,'MenuBar','none');

%Show GUI to user
set(Weather_GUI,'Visible', 'on');


