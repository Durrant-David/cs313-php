var fs = require('fs');
var filename = process.argv[2];
var buffer = fs.readFile(process.argv[2], function(err, data) {
  if (err) throw err;
//  console.log('OK: ' + filename);
//  console.log(data)
});

var str = buffer.toString();
console.log(str);