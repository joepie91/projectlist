<?php

require("Spyc.php");

$data = Spyc::YAMLLoad("projects.yaml");

$bins = array();

foreach($data["categories"] as $category => $category_data)
{
	$bins[$category] = array(
		"name" => $category_data["name"],
		"description" => $category_data["description"],
		"projects" => array()
	);
}

foreach($data["projects"] as $project_name => $project_data)
{
	$cat = $project_data["category"];
	$project_data["name"] = $project_name;
	
	if(isset($bins[$cat]))
	{
		$bins[$cat]["projects"][] = $project_data;
	}
}

?>


<html>
	<head>
		<title>Projects List</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="style.css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<h1>Projects List</h1>

			<p>
				This is a list of my projects. Active projects, abandoned projects, planned projects, everything. It may not yet be complete; changes will be made over time.
			</p>
			
			<p>
				If you're looking for my personal homepage, <a href="http://cryto.net/~joepie91">this is where you want to be</a>. Alternatively, you can <a href="http://cryto.net/~joepie91/donate.html">donate</a>.
			</p>
			
			<p>
				Each project indicates whether contributions are welcome or not. This refers primarily to code contributions (eg. in the form of a pull request). Bug reports may be accepted, even if code contributions aren't. If contributions are not accepted for a project, that generally means it is either undergoing an architectural change, in the design stages, or simply unmaintained.
			</p>

			<?php foreach($bins as $name => $bin): ?>
				<div class="category">
					<h2><?php echo($bin["name"]); ?></h2>
					<p><?php echo($bin["description"]); ?></p>

					<div class="projects">
						<?php foreach($bin["projects"] as $project): ?>
							<div class="project">
								<span class="buttons">
									<?php if(!empty($project["repository"])): ?>
										<a href="<?php echo($project["repository"]); ?>" class="top-bar link-repository pure-button" target="_blank"><i class="fa fa-github"></i> Repository</a>
									<?php endif; ?>
									
									<?php if(!empty($project["contributions_accepted"])): ?>
										<div class="top-bar contributions-yes"><i class="fa fa-code-fork"></i> Code contributions are welcome!</div>
									<?php else: ?>
										<div class="top-bar contributions-no"><i class="fa fa-times"></i> Code contributions not accepted</div>
									<?php endif; ?>
									
									<?php if(!empty($project["website"])): ?>
										<a href="<?php echo($project["website"]); ?>" class="top-bar link-website pure-button" target="_blank"><i class="fa fa-external-link-square"></i> Website</a>
									<?php endif; ?>
								</span>
								
								<div class="contents">
									<h3><?php echo($project["name"]); ?></h3>
									
									<p class="license">
										<?php if(!empty($project["version"])): ?>
											v<?php echo($project["version"]); ?> - 
										<?php endif; ?>
										<?php if(!empty($project["license"])): ?>
											<?php echo($project["license"]); ?>
										<?php endif; ?>
									</p>
									
									<?php if(!empty($project["notes"])): ?>
										<p class="notes"><i class="fa fa-info-circle"></i> <?php echo($project["notes"]); ?></p>
									<?php endif; ?>

									<p class="description"><?php echo($project["description"]); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</body>
</html>