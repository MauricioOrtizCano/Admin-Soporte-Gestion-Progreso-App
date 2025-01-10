import axios from "axios";
import Swal from "sweetalert2";

export const ERROR = "ERROR";
export const GET_USERS = "GET_USERS";
export const GET_SUPPORTCASES = "GET_SUPPORTCASES";
export const GET_COMMENTS = "GET_COMMENTS";
export const CREATE_SUPPORTCASE = "CREATE_SUPPORTCASE";
export const CREATE_USER_SUPPORTCASE = "CREATE_USER_SUPPORTCASE";
export const ASSIGN_AGENT = "ASSIGN_AGENT";
export const UPDATE_CASE_STATUS = "UPDATE_CASE_STATUS";
export const ADD_COMMENT = "ADD_COMMENT";
export const GET_AGENT = "GET_AGENT";
const url = "http://127.0.0.1:8000/api";

export const getUsers = () => {
  return async function (dispatch) {
    try {
      const response = await axios.get(`${url}/users`);
      //const users = response.data;
      //console.log(users.data);
      return dispatch({
        type: GET_USERS,
        payload: response.data,
      });
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const getSupportCases = () => {
  return async function (dispatch) {
    try {
      const response = await axios.get(`${url}/support-cases`);
      const supportCases = response.data;

      return dispatch({
        type: GET_SUPPORTCASES,
        payload: supportCases,
      });
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const getComments = () => {
  return async function (dispatch) {
    try {
      const response = await axios.get(`${url}/comments`);
      const comments = response.data;

      return dispatch({
        type: GET_COMMENTS,
        payload: comments,
      });
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const createSupportCase = (caseData) => {
  return async function (dispatch) {
    try {
      if (caseData.name === "") {
        const { requester_id, status, entry_date } = caseData;
        const response = await axios.post(`${url}/support-cases`, {
          requester_id,
          status,
          entry_date,
        });

        dispatch({
          type: CREATE_SUPPORTCASE,
          payload: response.data,
        });

        dispatch(getSupportCases());

        console.log(response.data);
      } else {
        const { name, lastname, email, status, role, entry_date } = caseData;

        const resposePostUser = await axios.post(`${url}/users`, {
          name,
          lastname,
          email,
          role,
        });

        const idNewUser = resposePostUser.data.data.id;

        await axios.post(`${url}/support-cases`, {
          requester_id: idNewUser,
          status,
          entry_date,
        });

        dispatch(getSupportCases());
        dispatch(getUsers());

        console.log("Usuario y Caso de Soporte creados");
      }
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const assignAgent = (caseId, agentId) => {
  return async function (dispatch) {
    try {
      await axios.post(`${url}/comments`, {
        support_case_id: caseId,
        agent_id: agentId,
        comments: [
          {
            text: "El Agente ha sido asignado",
          },
        ],
      });

      const response = await axios.put(`${url}/support-cases/${caseId}`, {
        agent_id: agentId,
        status: "assigned",
      });

      dispatch({
        type: ASSIGN_AGENT,
        payload: response.data,
      });

      // Recargar los casos para tener la lista actualizada
      dispatch(getSupportCases());

      return response.data;
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error.message,
      });
    }
  };
};

export const updateCaseStatus = (caseId, newStatus) => {
  return async function (dispatch) {
    try {
      const response = await axios.put(`${url}/support-cases/${caseId}`, {
        status: newStatus,
      });

      dispatch({
        type: UPDATE_CASE_STATUS,
        payload: response.data,
      });

      dispatch(getSupportCases());
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const addComment = (id, newComment) => {
  return async function (dispatch) {
    try {
      console.log("selectedCase: " + id);
      console.log(newComment.comments);

      //await axios.put(`${url}/comments/${id}`, newComment.comments);
      //const response = await axios.post(`${url}/comments`, commentData);
      // dispatch({
      //   type: ADD_COMMENT,
      //   payload: response.data,
      // });
      dispatch(getComments());
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};

export const getAgent = (id) => {
  return async function (dispatch) {
    try {
      const response = await axios.get(`${url}/users/${id}`);
      return dispatch({
        type: GET_AGENT,
        payload: response.data,
      });
    } catch (error) {
      return dispatch({
        type: ERROR,
        payload: error,
      });
    }
  };
};
