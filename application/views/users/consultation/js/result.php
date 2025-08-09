<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
    // Data pohon dari PHP
    var treeData = <?= $tree_json ?>;

    // Set ukuran
    var margin = {
            top: 20,
            right: 90,
            bottom: 30,
            left: 90
        },
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var svg = d3.select("#tree-container").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var treemap = d3.tree().size([height, width]);
    var root = d3.hierarchy(treeData, function(d) {
        return d.children;
    });

    root.x0 = height / 2;
    root.y0 = 0;

    // Generate tree layout
    root = treemap(root);

    // Add links
    svg.selectAll(".link")
        .data(root.links())
        .enter().append("path")
        .attr("class", "link")
        .attr("fill", "none")
        .attr("stroke", "#ccc")
        .attr("stroke-width", 2)
        .attr("d", d3.linkHorizontal()
            .x(function(d) {
                return d.y;
            })
            .y(function(d) {
                return d.x;
            }));

    // Add nodes
    var node = svg.selectAll(".node")
        .data(root.descendants())
        .enter().append("g")
        .attr("class", "node")
        .attr("transform", function(d) {
            return "translate(" + d.y + "," + d.x + ")";
        });

    node.append("circle")
        .attr("r", 6)
        .attr("fill", "#69b3a2");

    node.append("text")
        .attr("dy", ".35em")
        .attr("x", function(d) {
            return d.children ? -10 : 10;
        })
        .attr("text-anchor", function(d) {
            return d.children ? "end" : "start";
        })
        .text(function(d) {
            return d.data.name;
        });
</script>