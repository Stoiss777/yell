SELECT
	t2.type, t2.value
FROM
(
	SELECT 
		type, MAX(data.date) md
	FROM 
		data
	GROUP BY
		data.type
) t1
INNER JOIN
	data AS t2 ON t1.type = t2.type AND t1.md = t2.date