function [ Season ] = Find_Season (Month, Day)
%This function uses the date provided by the internal clock and finds the
%season based upon the input data.
Season = {'Unknown', 0};
Spring_start = [03 20]; %%Spring Equinox
Spring_end = [06 20];
if ((Month >= Spring_start(1)&& Month <= Spring_end(1)) && ...
        (Day >= Spring_start(2) || Day <= Spring_end(2)))
    Season = {'Spring', 1};
end

Summer_start = [06 21]; %%Summer Solstice
Summer_end = [09 21];
if ((Month>=Summer_start(1) && Month<=Summer_end(1)) && ...
        (Day>=Summer_start(2) || Day<=Summer_end(2)))
    Season = {'Summer', 2};
end

Fall_start = [09 22];%%Fall Equinox
Fall_end = [12 20];
if ((Month>=Fall_start(1) && Month<=Fall_end(1)) && ...
        (Day>=Fall_start(2) || Day<=Fall_end(2)))
    Season = {'Fall', 3};
end

Winter_start = [12 21]; %%Winter Solstice
Winter_end = [03 19];
if ((Month>=Winter_start(1) && Month<=Winter_end(1)) && ...
        (Day>=Winter_start(2) || Day<=Winter_end(2)))
    Season = {'Winter', 4};
end

end

