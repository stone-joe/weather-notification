function [ Year, Month, Day, Time ] = Clock_Data(Internal_Clock)
%This function gets data from internal clock and stores it in the 
%appropriate variables.
Year = Internal_Clock(1);
Month = Internal_Clock(2);
Day = Internal_Clock(3);
Time = [Internal_Clock(4),Internal_Clock(5),Internal_Clock(6)]; 
end

