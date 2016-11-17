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

COLUMN_NAMES = ['A', 'B', 'C', 'E', 'F', 'G', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']

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
  if (origin === target) { // j'ai trouvé
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
        var newPath
        newPath = path
        path.push(newColnames[i])
        var res = getPath(target, newColnames[i], newMatrix, newColnames, newPath)
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

function Graph(matrix, vertexName){
  this.matrix = matrix
  this.vertexName = vertexName
}

Graph.prototype.getPath = function (origin, target){
  return getPath(target, origin, this.matrix, this.vertexName, [origin])
}

function getNullMatrix (width, height) {
  var nullLines = []
  var nullMatrix = []
  for (var i = 0; i < width; i++) {
    nullLines.push(0)
  }
  for (i = 0; i < height; i++) {
    nullMatrix.push(nullLines)
  }
  return nullMatrix
}

console.log(getNullMatrix(3, 4))

function Labyrinthe (width, height) {
  this.width = width
  this.height = height
  this.matrix = getNullMatrix(width * height, width * height)
  this.cells = this.cellList()
}

Labyrinthe.prototype.cellList = function () {
  var cells = []
  for (var i = 0; i < this.width; i++) {
    for (var j = 1; j <= this.height; j++) {
      cells.push(COLUMN_NAMES[i] + j)
    }
  }
  return cells
}

Labyrinthe.prototype.cellIndex = function (name) {
  return this.cells.indexOf(name)
}

var labyrinthe
labyrinthe = new Labyrinthe(3, 3)
console.log(labyrinthe.cells)
console.log(labyrinthe.cellIndex('A1'))

//var Graph
//graph = new Graph(MATRIX, COLUMN_NAMES)

// console.log(getPath('K', 'A', MATRIX, COLUMN_NAMES, 'A'))
//console.log(getPath('I', 'C', MATRIX, COLUMN_NAMES, 'C'))
