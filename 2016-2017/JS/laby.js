// Bailleux Robin
// Résolution de labyrinthe

// labyrinthe
// +---+---+---+
// | A | B   C |
// +   +   +---+
// | E   F   G |
// +   +   +   +
// | I   J | K |
// +---+---+---+

var MATRIX        // matrice d'adjacence
var COLUMN_NAMES  // nom des colonnes

// A  B  C  E  F  G  I  J  K
MATRIX = [
  [0, 0, 0, 1, 0, 0, 0, 0, 0], // A
  [0, 0, 1, 0, 1, 0, 0, 0, 0], // B
  [0, 1, 0, 0, 0, 0, 0, 0, 0], // C
  [1, 0, 0, 0, 1, 0, 1, 0, 0], // E
  [0, 1, 0, 1, 0, 1, 0, 1, 0], // F
  [0, 0, 0, 0, 1, 0, 0, 0, 1], // G
  [0, 0, 0, 1, 0, 0, 0, 1, 0], // I
  [0, 0, 0, 0, 1, 0, 1, 0, 0], // J
  [0, 0, 0, 0, 0, 1, 0, 0, 0]  // K
]

COLUMN_NAMES = ['A', 'B', 'C', 'E', 'F', 'G', 'I', 'J', 'K']

function subSet (index, length, getValue) {
  var result
  result = []
  for (var i = 0; i < length; i++) {
    if (i !== index) {
      result.push(getValue(i))
    }
  }
  return result
}

function subVector (v, index) {
  return subSet(index, v.length, function (i) {
    return v[i]
  })
}

function subMatrix (m, index) {
  return subSet(index, m.length, function (i) {
    return subSet(index, m.length, function (j) {
      return m[i][j]
    })
  })
}

// console.log('suVector', subVector(MATRIX[1], 2))

// target : cible nom de la cellule -> "K"
// origin : "A"
// matrix : matrice d'adjacence MATRIX
// columnNames : nom des colonnes
// path : ""
function getPath (target, origin, matrix, columnNames, path) {
  if (origin === target) { // j'ai trouv�
    return path
  } else {
    var iOrigin, newMatrix, newColnames
    iOrigin = columnNames.indexOf(origin)
    newColnames = subVector(columnNames, iOrigin)
    for (var i = 0; i < newColnames.length; i++) {
      var hasArc
      hasArc = matrix[iOrigin][columnNames.indexOf(newColnames[i])]
      if (hasArc) {
        newMatrix = subMatrix(matrix, iOrigin)
        var res = getPath(target, newColnames[i], newMatrix, newColnames, path.concat([newColnames[i]]))
        if (res) {
          return res
        }
      }
    }
    return null
  }
  // something
  return path
}

// console.log(getPath('K', 'A', MATRIX, COLUMN_NAMES, 'A'))
console.log('getPath:', getPath('I', 'C', MATRIX, COLUMN_NAMES, ['C']))

function Graph (matrix, vertexNames) {
  this.matrix = matrix
  this.vertexNames = vertexNames
}

Graph.prototype.getPath = function (origin, target) {
  return getPath(target, origin, this.matrix, this.vertexNames, [origin])
}

var g = new Graph(MATRIX, COLUMN_NAMES)
console.log('Graph#getPath:', g.getPath('C', 'I'))

function getNullMatrix (width, height) {
  var nullMatrix = []
  for (var i = 0; i < width; i++) {
    nullMatrix[i] = []
    for (var j = 0; j < height; j++) {
      nullMatrix[i][j] = 0
    }
  }
  return nullMatrix
}

console.log('getNullMatrix:', getNullMatrix(3, 2))

function Labyrinthe (width, height) {
  this.width = width
  this.height = height
  this.matrix = getNullMatrix(width * height, width * height)
  this.cells = this.cellList()
}

Labyrinthe.prototype.cellList = function () {
  var cells = []
  for (var i = 1; i <= this.width; i++) {
    for (var j = 0; j < this.height; j++) {
      cells.push(COLUMN_NAMES[j] + i)
    }
  }
  return cells
}

var labyrinthe = new Labyrinthe(3, 3)
console.log('Labyrinthe#cellList:', labyrinthe.cellList())

Labyrinthe.prototype.cellIndex = function (name) {
  return this.cells.indexOf(name)
}

console.log('Labyrinthe#cellIndex:', labyrinthe.cellIndex('B2'))

Labyrinthe.prototype.cellOpen = function (cellName, direction) {
  var x = COLUMN_NAMES.indexOf(cellName.substr(0, 1))
  var y = cellName.substr(1)
  var openX = (y - 1) * this.width + x
  var openY
  if (direction === 'bottom') {
    openY = y * this.width + x
    this.matrix[openX][openY] = 1
    this.matrix[openY][openX] = 1
  }
  if (direction === 'right') {
    openY = openX + 1
    this.matrix[openX][openY] = 1
    this.matrix[openY][openX] = 1
  }
}

labyrinthe.cellOpen('A1', 'bottom') // vers A2
labyrinthe.cellOpen('B1', 'bottom') // vers B2
labyrinthe.cellOpen('B1', 'right')  // vers C1
labyrinthe.cellOpen('A2', 'bottom') // vers A3
labyrinthe.cellOpen('A2', 'right')  // vers B2
labyrinthe.cellOpen('B2', 'bottom') // vers B3
labyrinthe.cellOpen('B2', 'right')  // vers C2
labyrinthe.cellOpen('C2', 'bottom') // vers C3
labyrinthe.cellOpen('A3', 'right')  // vers B3
console.log('Labyrinthe#matrix:', labyrinthe.matrix)

Labyrinthe.prototype.getPath = function (source, destination) {
  var labGraph = new Graph(this.matrix, this.cellList())
  return labGraph.getPath(source, destination, labGraph.matrix, labGraph.vertexNames, [source])
}

console.log(labyrinthe.getPath('A1', 'C3'))


// labyrinthe.matrix contient
// [
// [0, 0, 0, 1, 0, 0, 0, 0, 0],
// [0, 0, 1, 0, 1, 0, 0, 0, 0],
// [0, 1, 0, 0, 0, 0, 0, 0, 0],
// [1, 0, 0, 0, 1, 0, 1, 0, 0],
// [0, 1, 0, 1, 0, 1, 0, 1, 0],
// [0, 0, 0, 0, 1, 0, 0, 0, 1],
// [0, 0, 0, 1, 0, 0, 0, 1, 0],
// [0, 0, 0, 0, 1, 0, 1, 0, 0],
// [0, 0, 0, 0, 0, 1, 0, 0, 0]
//]

// A FAIRE: Exo 5 - Ajouter la m�thode `getPath` au prototype de Labyrinthe
//
//console.log('Labyrinthe#getPath:', labyrinthe.getPath('A1', 'C3'))
//
//function LabyrintheHTMLView (labyrinthe) {
//  this.labyrinthe = labyrinthe
//}
//
//LabyrintheHTMLView.prototype.draw = function () {
//  // A FAIRE: BONUS (optionnel) - Dessiner le labyrinthe
//  // retourne la fonction une chaine de caract�res repr�sentant du type:
//  //   '<table class="labyrinthe">...</table>'
//}
//
//var view = new LabyrintheHTMLView(labyrinthe)
//console.log('LabyrintheHTMLView#draw', view.draw())
