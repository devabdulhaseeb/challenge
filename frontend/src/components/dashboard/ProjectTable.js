import { Card, CardBody, CardTitle, CardSubtitle, Table } from "reactstrap";
import user1 from "../../assets/images/users/user1.jpg";
import user2 from "../../assets/images/users/user2.jpg";
import user3 from "../../assets/images/users/user3.jpg";
import user4 from "../../assets/images/users/user4.jpg";
import user5 from "../../assets/images/users/user5.jpg";
import React, { useEffect } from 'react'
import LoaderComponent from './Loader/index';
import axios from 'axios';
import { useState } from 'react';
import Swal from "sweetalert2";


const ProjectTables = () => {
  const [attendance, setAttendance] = useState([]);
  const [showLoader, setShowLoader] = useState(false); 

  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async (page = 1, filter = null, limit = 10) => {
    setShowLoader(true);
    // console.log(filter);
    let pages = page;
    const response = await axios.get('/get-attendance')
    .then(response => {
    const fetchedUsers = response.data.data;
    setAttendance(fetchedUsers);
    setShowLoader(false);
  })
  .catch(error => {
    console.log(error);
    Swal.fire({
      icon: 'error',
      title: `<h5 style="color: red">${error.response.data.message}</h5>`,
      confirmButtonColor: 'red',
    });
    setShowLoader(false);
  });
};


  return (
   
    <div>
      {showLoader ? (
      <LoaderComponent />
    ) : (
      <>
      <Card>
        <CardBody>
          <CardTitle tag="h5">Attendance Listing</CardTitle>
          <CardSubtitle className="mb-2 text-muted" tag="h6">
            Overview of the Attendance
          </CardSubtitle>
          {attendance.length > 0 ? (
          <Table className="no-wrap mt-3 align-middle" responsive borderless>
            <thead>
              <tr>
                <th>Name</th>
                <th>CheckIn</th>

                <th>CheckOut</th>
                <th>Total Working Hours</th>
              </tr>
            </thead>
         
            <tbody>
              {attendance.map((tdata, index) => (
                <tr key={index} className="border-top">
                  <td>
                    <div className="d-flex align-items-center p-2">
                      <div className="ms-3">
                        <h6 className="mb-0">{tdata.name}</h6>

                      </div>
                    </div>
                  </td>
                  <td>{tdata.checkin ?? 'N/A'}</td>
                  <td>{tdata.checkout ?? 'N/A'}</td>
                 
                  <td>{tdata.hours ?? 'N/A'}</td>
                  
                </tr>
              ))}
            </tbody>
            
          </Table>
          ):(<div className="col-lg-12 text-center">
            <h4>No Data Available</h4>
          </div>)}
        </CardBody>
      </Card>
      </>
      )}
    </div>
   
  );
};

export default ProjectTables;
