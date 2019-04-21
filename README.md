# papercraftplaza-model-viewer
A 3d model viewer that shows the papercrafts from our website database.

the single.php is the single post template for our papercraftplaza wordpress template.
Inside this php file there is a javascript that loads threejs. 

This webgl code makes a canvas and loads an .obj file and a texture file
(this obj link is hidden in the single post)
(the texture file should be called the same as the postID. 1645.jpg for example.)

things to do.
- make script load from .js file instead of embedded.
- make script read through uploaded .zip file or .rar file and use the 3d data from any .pdo file.

