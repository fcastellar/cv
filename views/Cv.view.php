<?php
/*
 * @author Fernando Castellar Mendez
 * @description Class VIEW to show in the screen the CV tables, experience and education
 * @version 1.0
 */

class CvView {

    /*
     * @function: showExperience
     * @author: Fernando Castellar Mendez
     * @description: It shows the experience table, getting all the rows of the database and printing them on the
     *               screen with a for each
     * @param: array $experiences Pairs key/value of the experience's rows
     * @access: public
     * @version: 1.0
     */
    public static function showExperience($experiences) { ?>
        <div class="container experienceContainer">
            <div class="information">
                <div class="blueTitle" onclick="showExperience()">
                    experience
                </div>
                <div class="button addButton <?php if (!isset($_SESSION["idUser"])) echo 'hidden';?>" id="experienceEditButton" onclick="addNewExperience();">
                    Add
                </div>
                <div class="button saveButton <?php if (!isset($_SESSION["idUser"])) echo 'hidden';?>" id="experienceSaveButton" onclick="saveExperience();">
                    Save
                </div>
                <div id="experienceData" class="dataContainer">
                    <table id="experienceTable" class="cvTable">
                        <thead>
                            <th class="hidden">ID</th>
                            <th class="removeColumn">Remove</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Company</th>
                            <th>Tasks</th>
                            <th>Skills</th>
                            <th>Example</th>
                            <th>Date start</th>
                            <th>Date end</th>
                        </thead>
                        <tbody>
                        <?php foreach ($experiences as $experience) { ?>
                            <tr id="exp_<?php echo $experience['id_experience'] ?>">
                                <td class="hidden"><?php echo $experience['id_experience'] ?></td>
                                <th class="removeColumn removeRow"><div class="removeButton" onclick="removeExperience(<?php echo $experience['id_experience']?>)"></div></th>
                                <td><?php echo $experience['title'] ?></td>
                                <td><?php echo $experience['position'] ?></td>
                                <td><?php echo $experience['company'] ?></td>
                                <td><?php echo $experience['tasks'] ?></td>
                                <td><?php echo $experience['skills'] ?></td>
                                <td><?php echo $experience['examples'] ?></td>
                                <td><?php echo $experience['date_start'] ?></td>
                                <td><?php echo (($experience['date_end'] > 0)? $exp['date_end']:"Actual job") ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php //return TRUE;
    }

    /*
     * @function: showEducation
     * @author: Fernando Castellar Mendez
     * @description: It shows the education table, getting all the rows of the database and printing them on the
     *               screen with a for each
     * @param: array $educations Pairs key/value of the education's rows
     * @access: public
     * @version: 1.0
     */
    public static function showEducation($educations) { ?>

        <body>
        <div class="container educationContainer">
            <div class="information">
                <div class="blueTitle" onclick="showEducation()">
                    education
                </div>
                <div class="button addButton <?php if (!isset($_SESSION["idUser"])) echo 'hidden';?>" id="educationEditButton" onclick="addNewEducation();">
                    Add
                </div>
                <div class="button saveButton <?php if (!isset($_SESSION["idUser"])) echo 'hidden';?>" id="educationSaveButton" onclick="saveEducation();">
                    Save
                </div>
                <div id="educationData" class="dataContainer">
                    <table id="educationTable" class="cvTable">
                        <thead>
                            <th class="hidden">ID</th>
                            <th class="removeColumn">Remove</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Centre</th>
                            <th>Recap</th>
                            <th>Date start</th>
                            <th>Date end</th>
                        </thead>
                        <tbody>
                        <?php foreach ($educations as $education) { ?>
                            <tr id="edu_<?php echo $education['id_education'] ?>">
                                <td class="hidden"><?php echo $edu['id_education'] ?></td>
                                <td class="removeColumn removeRow"><div class="removeButton" onclick="removeEducation(<?php echo $education['id_education']?>)"></div></td>
                                <td><?php echo $education['title'] ?></td>
                                <td><?php echo $education['type'] ?></td>
                                <td><?php echo $education['centre'] ?></td>
                                <td><?php echo $education['recap'] ?></td>
                                <td><?php echo $education['date_start'] ?></td>
                                <td><?php echo (($education['date_end'] > 0)? $edu['date_end']:"Not finished") ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </body>

        <?php // return TRUE;
    }

    /*
     * @function: addExperienceRow
     * @author: Fernando Castellar Mendez
     * @description: It generates the view of a single empty row for the experience table of the CV, just inserting
     *               the experience's id
     * @param: int $idExperience Identifier of the just inserted experience
     * @access: public
     * @version: 1.0
     */
    public static function addNewExperienceRow($idExperience) { ?>
        <tr id="exp_<?php echo $idExperience?>">
            <td class="hidden"><?php echo $idExperience?></td>
            <th class="removeRow"><div class="removeButton" onclick="removeExperience(<?php echo $idExperience ?>)"></div></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php }

    /*
     * @function: addEducationRow
     * @author: Fernando Castellar Mendez
     * @description: It generates the view of a single empty row for the education table of the CV, just inserting
     *               the education's id
     * @param: int $idEducation Identifier of the just inserted education
     * @access: public
     * @version: 1.0
     */
    public static function addNewEducationRow($idEducation) { ?>
        <tr id="edu_<?php echo $idEducation?>">
            <td class="hidden"><?php echo $idEducation?></td>
            <th class="removeRow"><div class="removeButton" onclick="removeEducation(<?php echo $idEducation ?>)"></div></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php }
}