import {
  Card,
  Row,
  Col,
  CardTitle,
  CardBody,
  Button,
  Form,
  FormGroup,
  Label,
  Input,
  FormText,
} from "reactstrap";
import axios from 'axios';
import Swal from 'sweetalert2';
import LoaderComponent from '../../components/dashboard/Loader/index';
import { useState,useEffect } from 'react';
import { useNavigate } from 'react-router';

const Forms = () => {
  const [inputs, setInputs] = useState({});
  const navigate = useNavigate();
  const [uploadedFile1, setUploadedFile1] = useState([]);
  const [fileUrl1, setFileUrl1] = useState("");
  const [showLoader, setShowLoader] = useState(false); 


  const handleFileUpload1 = (event) => {
    const files = event.target.files;
    const fileUrls = Array.from(files).map((file) => URL.createObjectURL(file));
    setFileUrl1(fileUrls);
    setUploadedFile1(files);
    // console.log(fileUrls);
  };


  const submitForm = ()=>{
    const formData = new FormData();
  
      console.log('uploadedFile: '+uploadedFile1[0]);
      if (uploadedFile1 && uploadedFile1.length > 0) {
        formData.append("excel_file", uploadedFile1[0]);
      } else {
        formData.append("excel_file", null); // Set to null
      }
    
    
    
    console.log(formData);
    // setShowLoader(true);
    
    axios.post('/create-attendance', formData, {
      headers: {
        "Content-Type": "multipart/form-data", // Important for file uploads
      },
    }).then((res) => {
      setShowLoader(false);
      Swal.fire({
        icon: 'success',
        title: '<h5 style=color:green>"' + res.data.message + '"</h5>',
        confirmButtonColor: 'green',
      });
      navigate('/starter');
    })
    .catch((error) => {
      setShowLoader(false);
      Swal.fire({
        icon: 'error',
        title: '<h5 style=color:red>"' + error.response.data.message + '"</h5>',
        confirmButtonColor: 'red',
      });
    });
  }
  return (
    <Row>
      <Col>
      
        <Card>
          <CardTitle tag="h6" className="border-bottom p-3 mb-0">
            <i className="bi bi-bell me-2"> </i>
            Upload Attendance In Excel Format
          </CardTitle>
          <CardBody>
            <Form>
              
              <FormGroup>
                <Label for="exampleFile">Attendance Record File</Label>
                <Input id="excel_file" name="excel_file" type="file" onChange={handleFileUpload1} />
                <FormText>
                  Use xlsx,xls file only
                </FormText>
              </FormGroup>
             
              <Button onClick={submitForm}>Upload</Button>
            </Form>
          </CardBody>
        </Card>
      </Col>
    </Row>
  );
};

export default Forms;
