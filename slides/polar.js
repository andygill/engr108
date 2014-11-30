// Original Coords
x = 3; y = 4;

// Target Coords
xt = 5; yt = 2;

// Take the difference betweent the vectors
xd = xt - x;
yd = yt - y;

// Compute the radians
r = Math.atan2(yd,xd);

// Print the result
console.log(r);
