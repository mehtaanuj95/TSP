var cities = [];
var totalCities = 24;

var popSize = 50;
var population = [];
var fitness = [];

var recordDistance = Infinity;
var bestEver;
var currentBest;

var statusP;
var totalGenerations = 100;
var currentGeneration;

//Define start and end Times
var startTime;
var endTime;

//Mutation Rate
var mutationRate = 0.01;

//Greatest and the least values that the coordinates can take
var xMax = 500;     //These values are pixels
var yMax = 500;

//Cost MAtrix
var cost = [];

//--------------------Pre-Processing-------------------------//

  //Create cost matrix
  //Step - 1 : Create lower trianglualr matrix
  for(var i = 0; i < totalCities; i++)
  {
    cost[i] = new Array(totalCities);
    for(var j = 0; j <= i; j++ )
    {
      if(i == j) {
        cost[i][j] = 0;
      }
      else {
        cost[i][j] = Math.floor(Math.random()*(xMax+1));
      }
    }
  }
  console.log(cost);
  //Step - 2 : Create rest cost matrix
  for(var i = 0; i < totalCities; i++)
  {
    for(var j = i+1; j < totalCities; j++ )
    {
      cost[i][j] = cost[j][i];
    }
  }
  //console.table(cost);
  
  var order = [];
  //Create initial random order of cities
  for (var i = 0; i < totalCities; i++) {
    order[i] = i;
  }
  //console.log("Cities : ",cities);
  console.log("Order : ",order);

  //Create shuffled orders to fill up entire population
  population[0] = shuffle(order);
  for (var i = 1; i < popSize; i++) {
    
    population[i] = shuffle(population[i-1].slice());
  }
  currentGeneration = 1;
  console.log(population);

//-----------------------Pre-Procesing Ends---------------//

//-----------------------For Loop Starts------------------//

for(var z = 0; z <= totalGenerations; z++) {

  var d;
  if(currentGeneration == 1) {
    d = new Date();
    startTime = d.getTime();
  }
  
  // GA
  calculateFitness();
  normalizeFitness();
  nextGeneration();

  currentGeneration++;
  //console.log(currentGeneration);
  if(currentGeneration == totalGenerations) {
    console.log("recordDistance",recordDistance);
    console.log("bestEver",bestEver);
    
    //End Time
    var d2 = new Date();
    endTime = d2.getTime();
    
    console.log("total time elapsed in ms", endTime - startTime);
    break;
  }
}
//-----------------------For Loop Ends------------------------//
function swap(a, i, j) {
  var temp = a[i];
  a[i] = a[j];
  a[j] = temp;
}


function calcDistance(points, order) 
{
  var sum = 0;
  for (var i = 0; i < (order.length - 2); i++) {
    var cityAIndex = order[i];
    //var cityA = points[cityAIndex];
    var cityBIndex = order[i + 1];
    //var cityB = points[cityBIndex];
    //var d = dist(cityA.x, cityA.y, cityB.x, cityB.y);
    var d = cost[cityAIndex][cityBIndex];
    sum += d;
  }
  return sum;
}

function calculateFitness() {
  var currentRecord = Infinity;
  for (var i = 0; i < population.length; i++) {
    var d = calcDistance(cities, population[i]);
    if (d < recordDistance) {
      recordDistance = d;
      bestEver = population[i];
    }
    if (d < currentRecord) {
      currentRecord = d;
      currentBest = population[i];
    }
    fitness[i] = 1 / (Math.pow(d, 8) + 1);
  }
}

function normalizeFitness() {
  var sum = 0;
  for (var i = 0; i < fitness.length; i++) {
    sum += fitness[i];
  }
  for (var i = 0; i < fitness.length; i++) {
    fitness[i] = fitness[i] / sum;;
  }
}


function nextGeneration() {
  var newPopulation = [];
  for (var i = 0; i < population.length; i++) {
    var orderA = pickOne(population, fitness);
    var orderB = pickOne(population, fitness);
    var order = crossOver(orderA, orderB);
    mutate(order, mutationRate);
    newPopulation[i] = order;
  }
  population = newPopulation;

}

function pickOne(list, prob) {
  var index = 0;
  var r = Math.random();

  while (r > 0) {
    r = r - prob[index];
    index++;
  }
  index--;
  return list[index].slice();
}

function crossOver(orderA, orderB) {
  var start = Math.floor(Math.random()*(orderA.length));
  var end = Math.floor(Math.random() * ((orderA.length)) - (start + 1)) + (start + 1);
  var neworder = orderA.slice(start, end);
  // var left = totalCities - neworder.length;
  for (var i = 0; i < orderB.length; i++) {
    var city = orderB[i];
    if (!neworder.includes(city)) {
      neworder.push(city);
    }
  }
  return neworder;
}


function mutate(order, mutationRate) {
  for (var i = 0; i < totalCities; i++) {
    if (Math.random() < mutationRate) {
      var indexA = Math.floor(Math.random()*(order.length));
      var indexB = (indexA + 1) % totalCities;
      swap(order, indexA, indexB);
    }
  }
}



function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
