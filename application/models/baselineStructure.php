<?php


class MO {
	
	
	 var $MOName;
     var $NumParameters, $NumDescrepancies, $NumElements;
	 
	 function __construct(){
            $this->NumParameters = 0;
			$this->NumDescrepancies = 0;
			$this->NumElements = 0;
	 }
	 
	 
	 function getPercentage() {
		 
		 if ($this->NumDescrepancies==0) return '100%';
		 
		 $v_result  = 100 - $this->NumDescrepancies * 100 / ($this->NumElements * $this->NumParameters);
		 return number_format($v_result,2);
		 
	 }
	 
}

class Rule {
	
	var $ruleName, $checkValue, $MML, $isValidRule, $isMultipleCheckValue, $isSubParameter;
	var $elementForMML, $outputMML, $elementsChecked, $discrepanciesFound, $elementsSkipped;
	var $command, $parameterToCheck, $subParameterToCheck;
	var $checkValueAr;
	
	
	function __construct(){
            $this->ruleName = "";
            $this->checkValue = "";
            $this->MML = "";
            $this->isValidRule = false;
            $this->isMultipleCheckValue = false;
            $this->isSubParameter = false;
            $this->elementForMML = "";
            $this->outputMML = "";
            $this->elementsChecked = 0;
            $this->discrepanciesFound = 0;
            $this->elementsSkipped = 0;
            $this->command = "";
            $this->parameterToCheck = "";
            $this->subParameterToCheck = "";
            $this->checkValueAr = array();
	}	
	
	
	
	function setRuleDetails($row){
		//print_r($row);
		//echo $row['value1'];
		//var_dump($row[0]->{'MO'});
		$this->checkValue = $row['value1'];//$row->value1;
		$this->parameterToCheck=$row['parameter'];//$row->parameter;
		$this->MML=$row['MML'];//$row->MML;
		$this->subParameterToCheck=$row['subparameter'];//$row->subparameter;
		$this->command=$row['MO'];//$row->MO;
		
		//if ($row->subparameter!='') $this->isSubParameter = true;
		if ($row['subparameter']!='') $this->isSubParameter = true;
		
			//if ($row->value2!='') 
			if ($row['value2']!='') 
			{
				$this->isMultipleCheckValue = true; 
				//$this->checkValue =array($row->value1,$row->value2,$row->value3,$row->value4,$row->value5,$row->value6,$row->value7); // TODO: add all
				$this->checkValue =array($row['value1'],$row['value2'],$row['value3'],$row['value4'],$row['value5'],$row['value6'],$row['value7']); // TODO: add all
			}
		
      }
	  
	  
 	function setRuleDetails2($row){

		$this->checkValue = $row->value1;
		$this->parameterToCheck=$row->parameter;
		$this->MML=$row->MML;
		$this->subParameterToCheck=$row->subparameter;
		$this->command=$row->MO;
		
		if ($row->subparameter!='') $this->isSubParameter = true;
		
		
			if ($row->value2!='') 
			
			{
				$this->isMultipleCheckValue = true; 
				$this->checkValue =array($row->value1,$row->value2,$row->value3,$row->value4,$row->value5,$row->value6,$row->value7); // TODO: add all
			}
		
      }     
 
	
	function newRNC() {
            $this->outputMML = "";
            $this->elementsChecked = 0;
            $this->discrepanciesFound = 0;
            $this->elementsSkipped = 0;
	}
	
	
//			function suggestMML(ByVal p_hashTable As Hashtable)
//
//           'as input, we will use hashtable with all parameters
//            'If there is CELLID in hashtable, MML will be suggested for cell level, otherwise no element id will be used in MML
//            'Suggested MML will be like MOD and in specific cases SET
//
//            Dim v_isCellLevel, v_isSETMML As Boolean
//
//           Dim v_MMLCommand As String = ""
//
//           If Not IsNothing(p_hashTable("CELLID")) Then v_isCellLevel = True
//
//           If Me.command = "UCORRMALGOSWITCH" Then
//               v_isSETMML = True
//           End If
//
// 
//           v_MMLCommand = IIf(v_isSETMML, "SET ", "MOD ") & _
//                          Me.command & ":" & IIf(v_isCellLevel, "CELLID=%CELLID%, ", "") & _
//                          Me.parameterToCheck.ToUpper & "=" & IIf(Me.isSubParameter, Me.subParameterToCheck & "-", "") & Me.checkValue & _
//                          ";"
//
//           Me.SetCorrectionMML(v_MMLCommand)
//
//       End Sub

	
	
//       Public Sub SetCheckParameter(ByVal p_parameter As String)
//           If p_parameter.Split(".").Length < 2 Then
//               Exit Sub
//           End If
//
//           command = p_parameter.Split(".")(0)
//           parameterToCheck = p_parameter.Split(".")(1)
//
//           If p_parameter.Split(".").Length = 3 Then
//               isSubParameter = True
//               subParameterToCheck = p_parameter.Split(".")(2)
//           End If
//
//       End Sub
//
//       Public Sub SetIFNOT(ByVal p_ifnot As String)
//
//           Dim v_parameter As String
//
//           If p_ifnot.Split(".").Length < 2 OrElse p_ifnot.Contains("=") = False Then
//               Exit Sub
//           End If
//
//           v_parameter = p_ifnot.ToUpper.Split("=")(0)
//
//           command = v_parameter.ToUpper.Split(".")(0)
//           parameterToCheck = v_parameter.ToUpper.Split(".")(1)
//
//           If v_parameter.Split(".").Length = 3 Then
//               isSubParameter = True
//               subParameterToCheck = v_parameter.Split(".")(2)
//           End If
//
//           Me.checkValue = p_ifnot.ToUpper.Split("=")(1)
//
//           If Me.checkValue(0) = "(" Then
//               'Check if check value is a set of multiple values to be checked
//               Dim t_checkValue As String = Me.checkValue.Substring(1, Me.checkValue.Length - 2)
//               If t_checkValue(0) = "'" And t_checkValue(t_checkValue.Length - 1) = "'" Then
//                   Me.isMultipleCheckValue = True
//                   t_checkValue = t_checkValue.Substring(1, t_checkValue.Length - 2)
//                   checkValueAr = t_checkValue.Replace("','", "|").Split("|")
//               Else
//                   Exit Sub
//               End If
//           End If
//
//           If Me.ruleName = "" Then Me.ruleName = p_ifnot
//
//       End Sub
//
//
//       Public Sub SetCorrectionMML(ByVal p_MML As String)
//           If p_MML.Split("%").Length > 3 Then
//               'possibility to consider two parameters will be added in the future
//               Exit Sub
//           Else
//               If p_MML.Contains("%") Then
//                   elementForMML = p_MML.Split("%")(1)
//               Else
//                   elementForMML = Nothing
//               End If
//           End If
//
//           MML = p_MML
//
//       End Sub
//
//
//       Public Function generateRuleOutput()
//           Dim v_result As String
//
//           v_result = "Rule: " & Me.ruleName & vbTab & _
//                      "Elements: " & Me.elementsChecked & vbTab & _
//                      "Discrepancies: " & Me.discrepanciesFound & vbNewLine
//           Return v_result
//
//           '"In MO " & Me.command & " " & _
//           '           IIf(Me.isSubParameter, _
//           '                "checked if SUB parameter " & Me.subParameterToCheck & " of " & Me.parameterToCheck & " has value '" & Me.checkValue & "'", _
//           '                "checked if parameter " & Me.parameterToCheck & " has value '" & Me.checkValue & "'") & vbNewLine & _
//
//
//       End Function

	
}

?>