import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useSelector, useDispatch } from "react-redux";
import { Card, Button, Form } from "react-bootstrap";
import { getComments, getSupportCases } from "../../redux/actions";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import "./AgentPage.css";

const AgentPage = () => {
  const [selectedCase, setSelectedCase] = useState(null);
  const [newComment, setNewComment] = useState("");

  const { id } = useParams();
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const supportCases = useSelector(
    (state) =>
      state.supportCases?.data.filter(
        (caso) => caso.agent_id === parseInt(id)
      ) || []
  );

  const comments = useSelector((state) => state.comments?.data || []);
  //console.log(comments);

  useEffect(() => {
    dispatch(getSupportCases());
    dispatch(getComments());
  }, [dispatch]);

  const handleStatusChange = async (caseId, newStatus) => {
    try {
      await axios.put(`http://127.0.0.1:8000/api/support-cases/${caseId}`, {
        status: newStatus,
      });

      dispatch(getSupportCases());
    } catch (error) {
      console.error(error);
    }
  };

  const handleAddComment = async (e) => {
    e.preventDefault();

    try {
      const findComment = comments.filter(
        (comment) => comment.support_case_id === selectedCase.id
      );

      if (!findComment) {
        console.log("No se encontro ID");
        console.log(newComment);
      }

      const commentID = findComment[0].id;
      //console.log(findComment[0].id);
      await axios.put(`http://127.0.0.1:8000/api/comments/${commentID}`, {
        comments: {
          text: newComment,
        },
      });

      dispatch(getComments());
      setNewComment("");
    } catch (error) {
      console.error(error);
    }
  };

  const handleBackToHome = () => {
    navigate("/");
  };

  return (
    <div className="container mt-4">
      <h2>Mis casos</h2>
      <div className="row">
        <div className="row">
          <div className="col-md-6">
            {supportCases.map((caso) => (
              <Card
                key={caso.id}
                className="mb-3"
                onClick={() => setSelectedCase(caso)}
              >
                <Card.Body>
                  <Card.Title>Caso #{caso.id}</Card.Title>
                  <div className="mb-3">
                    <strong>Estado Actual: </strong>
                    <span className={`status-badge ${caso.status}`}>
                      {caso.status}
                    </span>
                  </div>
                  <div className="d-flex gap-2">
                    <Button
                      size="sm"
                      variant="outline-primary"
                      disabled={caso.status === "in_progress"}
                      onClick={() => handleStatusChange(caso.id, "in_progress")}
                    >
                      En Progreso
                    </Button>
                    <Button
                      size="sm"
                      variant="outline-success"
                      disabled={caso.status === "finished"}
                      onClick={() => handleStatusChange(caso.id, "finished")}
                    >
                      Finalizar
                    </Button>
                  </div>
                </Card.Body>
              </Card>
            ))}
          </div>

          <div className="col-md-6">
            {selectedCase && (
              <Card>
                <Card.Header>
                  <h5>Comentarios - Caso #{selectedCase.id}</h5>
                </Card.Header>
                <Card.Body>
                  <div className="comments-section mb-3">
                    {comments
                      .filter(
                        (comment) => comment.support_case_id === selectedCase.id
                      )
                      .map((comment) => (
                        <div
                          key={comment.id}
                          className="comment p-2 border-bottom"
                        >
                          {comment.comments.map((com, index) => {
                            return (
                              <div key={index}>
                                <p className="mb-1">{com.text}</p>
                                <small className="text-muted">
                                  {new Date(com.timestamp).toLocaleString()}
                                </small>
                              </div>
                            );
                          })}
                        </div>
                      ))}
                  </div>
                </Card.Body>
                <Card.Footer>
                  <Form onSubmit={handleAddComment}>
                    <Form.Group>
                      <Form.Control
                        as="textarea"
                        rows={3}
                        value={newComment}
                        placeholder="Escribe un comentario..."
                        onChange={(e) => setNewComment(e.target.value)}
                      />
                    </Form.Group>
                    <Button type="submit" className="mt-2">
                      Añadir Comentario
                    </Button>
                  </Form>
                </Card.Footer>
              </Card>
            )}
          </div>
        </div>
      </div>
      <Button
        size="lg"
        variant="warning"
        onClick={handleBackToHome}
        className="back-to-home-button"
      >
        Regresar al inicio
      </Button>
    </div>
  );
};

export default AgentPage;
