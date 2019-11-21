beforeEach ->
  placeholder = $('<div id="graph" style="width: 600px; height: 400px"></div>')
  $('#migrateSpec').append(placeholder)

afterEach ->
  $('#migrateSpec').empty()
