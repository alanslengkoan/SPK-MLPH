<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
    // Data pohon dari PHP (pastikan format: { name: "root", children: [...] })
    var treeData = <?= $tree_json ?>;

    // Hitung jumlah node untuk menentukan tinggi dinamis
    function countNodes(node) {
        let count = 1;
        if (node.children) {
            node.children.forEach(c => count += countNodes(c));
        }
        return count;
    }
    var totalNodes = countNodes(treeData);
    var nodeSpacing = 40; // jarak antar node
    var height = totalNodes * nodeSpacing;

    var margin = {
            top: 20,
            right: 90,
            bottom: 30,
            left: 150
        },
        width = 1200 - margin.left - margin.right;

    var svg = d3.select("#tree-container").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var treemap = d3.tree().size([height, width]);
    var root = d3.hierarchy(treeData);

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
            .x(d => d.y)
            .y(d => d.x));

    // Add nodes
    var node = svg.selectAll(".node")
        .data(root.descendants())
        .enter().append("g")
        .attr("class", "node")
        .attr("transform", d => "translate(" + d.y + "," + d.x + ")");

    node.append("circle")
        .attr("r", 5)
        .attr("fill", "#69b3a2");

    node.append("text")
        .attr("dy", ".35em")
        .attr("x", d => d.children ? -12 : 12)
        .attr("text-anchor", d => d.children ? "end" : "start")
        .style("font-size", "12px")
        .text(d => d.data.name);
</script>