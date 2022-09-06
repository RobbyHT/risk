<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add a 3D model</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<script src="https://unpkg.com/three@0.126.0/build/three.min.js"></script>
<script src="https://unpkg.com/three@0.126.0/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://unpkg.com/three@0.126.0/examples/js/loaders/ColladaLoader.js"></script>
<div id="map"></div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoicm9iYnlodCIsImEiOiJja3p3bmV3dWo0dzVnMm5xcnRjZHQyemExIn0.CG45FObydOZJhiJarTW6nw';
    const map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v11',
          center: [120.280, 23.093],
          zoom: 15,
          pitch: 40,
          bearing: 20,
          antialias: true
    });

    // parameters to ensure the model is georeferenced correctly on the map
    const modelOrigin = [120.280, 23.093];
    const modelAltitude = 0;
    const modelRotate = [Math.PI / 2, 0, 0];

    const modelAsMercatorCoordinate = mapboxgl.MercatorCoordinate.fromLngLat(
        modelOrigin,
        modelAltitude
    );

    // transformation parameters to position, rotate and scale the 3D model onto the map
    const modelTransform = {
        translateX: modelAsMercatorCoordinate.x,
        translateY: modelAsMercatorCoordinate.y,
        translateZ: modelAsMercatorCoordinate.z,
        rotateX: modelRotate[0],
        rotateY: modelRotate[1],
        rotateZ: modelRotate[2],
        /* Since the 3D model is in real world meters, a scale transform needs to be
         * applied since the CustomLayerInterface expects units in MercatorCoordinates.
         */
        //scale: modelAsMercatorCoordinate.meterInMercatorCoordinateUnits()
        scale: modelAsMercatorCoordinate.meterInMercatorCoordinateUnits()*10
    };

    const THREE = window.THREE;

    // configuration of the custom layer for a 3D model per the CustomLayerInterface
    const customLayer = {
        id: '3d-model',
        type: 'custom',
        renderingMode: '3d',
        onAdd: function (map, gl) {
            this.camera = new THREE.Camera();
            this.scene = new THREE.Scene();

            // create two three.js lights to illuminate the model
            const directionalLight = new THREE.DirectionalLight(0xffffff);
            directionalLight.position.set(0, -70, 100).normalize();
            this.scene.add(directionalLight);

            const directionalLight2 = new THREE.DirectionalLight(0xffffff);
            directionalLight2.position.set(0, 70, 100).normalize();
            this.scene.add(directionalLight2);

            // dae loader
            /*const loader = new THREE.ColladaLoader();
            loader.load(
                '/files/20220816.dae',
                (gltf) => {
                    this.scene.add(gltf.scene);
                }
            );*/
            // GLTF loader
            const loader = new THREE.GLTFLoader();
            loader.load(
                '/files/test.glb',
                (gltf) => {
                    this.scene.add(gltf.scene);
                }
            );
            this.map = map;

            // use the Mapbox GL JS map canvas for three.js
            this.renderer = new THREE.WebGLRenderer({
                canvas: map.getCanvas(),
                context: gl,
                antialias: true
            });

            this.renderer.autoClear = false;
        },
        render: function (gl, matrix) {
            const rotationX = new THREE.Matrix4().makeRotationAxis(
                new THREE.Vector3(1, 0, 0),
                modelTransform.rotateX
            );
            const rotationY = new THREE.Matrix4().makeRotationAxis(
                new THREE.Vector3(0, 1, 0),
                modelTransform.rotateY
            );
            const rotationZ = new THREE.Matrix4().makeRotationAxis(
                new THREE.Vector3(0, 0, 1),
                modelTransform.rotateZ
            );

            const m = new THREE.Matrix4().fromArray(matrix);
            const l = new THREE.Matrix4()
                .makeTranslation(
                    modelTransform.translateX,
                    modelTransform.translateY,
                    modelTransform.translateZ
                )
                .scale(
                    new THREE.Vector3(
                        modelTransform.scale,
                        -modelTransform.scale,
                        modelTransform.scale
                    )
                )
                .multiply(rotationX)
                .multiply(rotationY)
                .multiply(rotationZ);

            this.camera.projectionMatrix = m.multiply(l);
            this.renderer.resetState();
            this.renderer.render(this.scene, this.camera);
            this.map.triggerRepaint();
        }
    };

    map.on('style.load', () => {
        map.addLayer(customLayer, 'waterway-label');
    });
</script>

</body>
</html>