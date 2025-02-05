var num = 5;
var sum = cacl_expression(num);
console.log(sum);

function cacl_expression(number) {
  var sum = 0;
  for (var i=1; i<=number; i++) {
    sum += i / factorial(i);
  }
  return sum;
}


function factorial(num) {
  if (num === 0 || num === 1) {
    return 1;
  }
  return num * factorial(num - 1);
}