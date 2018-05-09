var numberPattern = /\d+/g;
var barWidth = 30;
var data = [4, 8, 15, 16, 23, 10, 42, 8, 23, 12];
var divID = 'viz';
var divVe = d3.select('#' + divID);

var margin = {
  top: 20,
  right: 20,
  bottom: 20,
  left: 20
};

function redner(dataset) {
  var svg = divVe.append('svg');
  var _width = divVe.style('width'),
    _height = divVe.style('height');
  //Lấy phần số ra, đề phòng các trường hợp có thêm px,em,...
  _width = _width.match(numberPattern)[0] - margin.right;
  _height = _height.match(numberPattern)[0] - margin.top;
  var chart = svg
    .attr("width", _width)
    .attr("height", _height);
  var x = d3.scaleBand()
    .range([0, _width]).padding(0.1);
  var y = d3.scaleLinear()
    .range([_height, 0]);

  var chart = svg.append("g").attr("class", "chart")
    .attr("transform", "translate(" + margin.left + "," + margin.bottom + ")");
  data = dataset;
  barWidth = (_width - margin.right - margin.left) / (data.length);
  //gán dữ liệu vào
  var _max = d3.max(dataset, function (d) {
    return d;
  });
  x.domain([0, dataset.length]);
  y.domain([0, _max]);
  var bars = chart.selectAll("g").remove().exit();
  var barsUpdate = bars.data(dataset).enter()
    .append("g")
    .attr("transform", function (d, i) {
      return "translate(" + i * barWidth + ",0)";
    });

  barsUpdate.append("rect")
    //   .on("mouseover", onMouseOver) //Add listener for the mouseover event
    //   .on("mouseout", onMouseOut) //Add listener for the mouseout event  
    .attr("class", "bar")
    .attr("y", function (d) {
      return y(d);
    })
    .attr("height", function (d) {
      return _height - y(d);
    })
    .attr("width", barWidth - 1);

  barsUpdate.append("text")
    .attr("y", function (d) {
      return y(d) + 3;
    })
    .attr("x", barWidth / 2)
    .attr("dy", ".75em")
    .text(function (d) {
      return d;
    });

  barsUpdate.exit().remove();
}

redner(data);

function swap(i, j) {
  let bar_i = d3.select('.chart').selectAll('g')
    .select(function (d, index) {
      return index == i ? this : null;
    });
  let bar_j = d3.select('.chart').selectAll('g')
    .select(function (d, index) {
      return index == j ? this : null;
    });
  let bar_itras = bar_i.style("transform");
  values = bar_j.style("transform").match(numberPattern);
  bar_i
    .transition() // adds animation
    .duration(400)
    .attr("transform", "translate(" + values[4] + ",0)");

  values = bar_itras.match(numberPattern);
  bar_j
    .transition() // adds animation
    .duration(400)
    .attr("transform", "translate(" + values[4] + ",0)");
  // bar_i.select('text').text(bar_j.select('text').text());     
  // bar_j.select('text').text(bar_itext);   
}

function selectbar(i, class_mark_name) {
  let bar_i = d3.select('.chart').selectAll('g')
    .select(function (d, index) {
      return index == i ? this : null;
    });
  bar_i.select('rect').attr('class', class_mark_name);
}

function unselectbar(i) {
  let bar_i = d3.select('.chart').selectAll('g')
    .select(function (d, index) {
      return index == i ? this : null;
    });
  bar_i.select('rect').attr('class', 'bar');
}
//mouseover event handler function
function onMouseOver(d, i) {
  d3.select(this).attr('class', 'highlight');
  d3.select(this)
    .transition() // adds animation
    .duration(400)
    .attr('y', function (d) {
      return y(d);
    })
    .attr('height', _height - y(d));
}

//mouseout event handler function
function onMouseOut(d, i) {
  // use the text label class to remove label on mouseout
  d3.select(this).attr('class', 'bar');
  d3.select(this)
    .transition() // adds animation
    .duration(400)
    .attr('height', _height - y(d))
    .attr('y', function (d) {
      return y(d);
    });
}