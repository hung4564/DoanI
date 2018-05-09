var n = data.length;
var delayInMilliseconds = 500; //1 second
var swapped = 0;
var vitridangxet = 1;
var done = false;
var index = [0];

function setbegin() {
  //lưu vị trí các phần từ trong data tương ứng với vị trí các thẻ trên htmt
  index = [0];
  for (let i = 1; i < n; i++) {
    index.push(i);
  }
  n = data.length;
  delayInMilliseconds = 500; //1 second
  swapped = 0;
  vitridangxet = 1;
  done = false;
}
setbegin();

function bubblesort() {
  console.log('chay thuat toan bubble sort');
  setbegin();
  var loop = setInterval(function() {
    bubblesort_next();
    if (done){
      clearInterval(loop);
    }
  }, delayInMilliseconds);
}
// function bubblesort() {
//   console.log('chay thuat toan bubble sort');
//   do {
//     swapped = false
//     for (var j = 1; j < n - 1; j++) {
//       setTimeout(function () {
//         console.log('xet vi tri ' + j);
//         selectbar(j);
//       }, delayInMilliseconds);
//       setTimeout(function () {
//         if (data[j - 1] > data[j]) {
//           var temp = data[j - 1];
//           data[j - 1] = data[j];
//           data[j] = temp;
//           swapped = true;
//           swap((j - 1), j);
//         }
//       }, delayInMilliseconds);
//       setTimeout(function () {

//         unselectbar(j);
//       }, delayInMilliseconds);
//     }
//   } while (!swapped)
// }

function bubblesort_next() {
  if (done) {
    return;
  } else {
    console.log('xet vi tri ' + vitridangxet);
    selectbar(index[vitridangxet], 'highlight');
    selectbar(index[vitridangxet - 1], 'highlight');
    if (data[vitridangxet - 1] > data[vitridangxet]) {
      swapped = 0;
      console.log("Do " + data[vitridangxet - 1] + ">" + data[vitridangxet] + " nên ta hoán vị chúng");
      var temp = data[vitridangxet - 1];
      data[vitridangxet - 1] = data[vitridangxet];
      data[vitridangxet] = temp;
      //chỉnh lại vị trí tương ứng
      temp = index[vitridangxet - 1];
      index[vitridangxet - 1] = index[vitridangxet];
      index[vitridangxet] = temp;
      swap(index[vitridangxet], index[vitridangxet - 1]);
    } else {
      swapped++;
    }
    setTimeout(function () {
      selectbar(index[vitridangxet - 1], 'bar');
      if (vitridangxet == (n - 1)) {
        selectbar(index[vitridangxet], 'bar');
      }
      if (vitridangxet < n - 1) vitridangxet++;
      else {
        vitridangxet = 1;
        swapped = 0;
      }
      console.log('chayxong');
    }, delayInMilliseconds);

    if (swapped == n - 1) {
      window.alert('thuat toan chay xong');
      done = true;
    }
  }

}