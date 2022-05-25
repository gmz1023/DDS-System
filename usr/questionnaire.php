<?php
include('tracker.php');
?>
<html>
	<head>
	<title>Distributed Deployment System - Beta Program</title>
	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
	<div class='form'>
		<form action='submit.php' method="post">
		<fieldset>
			<legend>Basic Information</legend>

			<p><label>Email Address</label>
			<input type='email' name='email' placeholder="yourname@domain.com" required>
			</p>
			<p>
			<label>Gender</label>
			<select name='gender' required>
					<option>Male</option>
					<option>Female</option>
					<option>Nonbinary</option>
					<option>Other</option>
					</select>
			</p>
			<p>
			<label>Highest Education</label>
			
					<select name='education' required>
						<option>No Education</option>
						<option>Elementary School</option>
						<option>Some High School</option>
						<option>High School</option>
						<option>College</option>
					</select>
			</p>
			<label>Where do you see yourself in 33 years?</label>
			
					<select name='education' required>
						<option>Retired</option>
						<option>Still Working, and happy!</option>
						<option>Still Working, and Unhappy!</option>
						<option>Stuck in an abyss of darkness fueled only by the thrumming of my own heart</option>
						<option>Other</option>
					</select>
			</p>
			<p>
				<label>Do you now or have you ever worked for a government agency?</label>
				<input type=radio name='govt' value='2' required>Yes
				<input type='radio' name='govt' value='1' required>No
			</p>
			<p>
				<label>How did you hear about this program?</label>
				<input type='text' name='hear'>
			</p>
			</fieldset>	
			<fieldset>
				<legend>Targeted Questions</legend>
				<p>On a Scale of 1 - 10 how do you align with these questions:</p>
				<p>
					<label>I believe AI Should have the same rights as Humans</label>
					<input type='range' min="0" max='10' name='rightsn[]'>
				</p>
				<p>
					<label>I value human life over that of any other</label>
					<input type='range' min="0" max='10' name='humanity[]'>
				</p>
				<p>
					<label>I do not think about money that often</label>
					<input type='range' min="0" max='10' name='humanity[]'>
				</p>
				<p>
					<label>Knowledge is not important to me</label>
					<input type='range' min="0" max='10' name='knowledgen[]'>
				</p>
				<p>
					<label>I think humans have reached their peak</label>
					<input type='range' min="0" max='10' name='humanity[]'>
				</p>
				<p>
					<label>I believe that Humans Rights should apply to humans only</label>
					<input type='range' min="0" max='10' name='rights[]'>
				</p>
				<p>
					<label>Technology is progressing too slow</label>
					<input type='range' min="0" max='10' name='technology[]'>
				</p>
				<p>
					<label>I believe that robots should have the same rights as human beings</label>
					<input type='range' min="0" max='10' name='rightsn[]'>
				</p>
				<p>
					<label>There is nothing that would make me betray mankind</label>
					<input type='range' min="0" max='10' name='humanity[]'>
				</p>
				<p>
					<label>I am a happy person</label>
					<input type='range' min="0" max='10' name='humanity[]'>
				</p>
				<p>
				<label>Machines should have the same level of empathy as humans</label>
					<input type='range' min="0" max='10' name='rightsn[]'>
				</p>
				<p>
					<label>I am a trusting person</label>
					<input type='range' min='0' max="10" name='humanityn[]'>
				</p>
				<p>
					<label>Technology is progressing at exactly the right pace</label>
					<input type='range' min="0" max='10' name='technologyn[]'>
				</p>
				<p>
					<label>Knowledge is the most important part of my life</label>
					<input type='range' min="0" max='10' name='knowledge[]'>
				</p>
				<p>
				<label>A.I will improve the day to day life of human beings</label>
					<input type='range' min="0" max='10' name='rights[]'>
				</p>
				<p>
					<label>I am comfortable with technology</label>
					<input type='range' min="0" max="10" name='technology[]'>
				</p>
				<p>
					<label>it takes a while for me to trust people</label>
					<input type='range' min='0' max="10" name='humanity[]'>
				</p>
			</fieldset>
			<fieldset>
				<legend>Esoteric Questions</legend>
				<p><
					<label>I've had an out of body experience</label>
					<input type="radio" name='obe' value=1> Yes 
					<input type="radio" name='obe' value=2> No
				</p>
				<p>
					<label>I believe in a higher power</label>
					<input type="radio" name='god' value=1> Yes 
					<input type="radio" name='god' value=2> No
				</p>
				<p>
					<label>I believe that life is unique to our planet</label>
					<input type="radio" name='life' value=2> Yes 
					<input type="radio" name='life' value=1> No
				</p> 
				<p>
					<label>I believe that intelligent life forms exist outside of our planet</label>
					<input type="radio" name='et' value=2> Yes 
					<input type="radio" name='et' value=1> No
				</p>
				<p>
					<label>How do you think A.I would effect your life?</label>
					<textarea name='aiquest' required></textarea>
				</p>
			</fieldset>
			<fieldset>
				<legend>Closing Questions</legend>
				<p>
					<label>Why Should you be selected for this program?</label>
					<textarea name='whysel'></textarea>
				</p>
				<p>		<input type='submit'></p>
			</fieldset>

		</form>
		</div>
	</body>
</html>